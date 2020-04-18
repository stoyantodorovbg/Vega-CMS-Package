<?php

namespace App\Services;

use App\Models\Group;
use App\Models\Route;
use App\Repositories\Interfaces\RouteRepositoryInterface;
use App\Services\Interfaces\RouteServiceInterface;
use App\Services\Interfaces\ValidationServiceInterface;

class RouteService implements RouteServiceInterface
{
    /**
     * @var ValidationServiceInterface
     */
    protected $validationService;

    /**
     * RouteService constructor.
     * @param ValidationServiceInterface $validationService
     */
    public function __construct(
        ValidationServiceInterface $validationService
    ) {
        $this->validationService = $validationService;
    }

    /**
     * Create a route
     *
     * @param array $data
     * @return mixed
     */
    public function create(array $data)
    {
        $data['action'] = $this->processAction($data['action'], $data['action_type']);

        $validatedData = $this->validationService->validate(
            $data,
            ['url', 'method', 'action', 'name', 'routeType', 'actionType'],
            'route',
            'create'
        );

        unset($data['action_type']);

        if ($validatedData === true &&
            $this->writeRoute($data) &&
            (Route::create($data))
        ) {
            return true;
        }

        return $validatedData;
    }

    /**
     * Destroy route
     *
     * @param array $data
     * @return array|bool
     */
    public function destroy(array $data)
    {
        $validatedData = $this->validationService->validate(
            $data,
            ['name'],
            'route',
            'exists'
        );

        if ($validatedData === true) {
            $route = Route::where('name', $data['name'])->first();
            $this->eraseRoute($route);
            $route->delete();
        }

        return $validatedData;
    }

    /**
     * Synchronize routes
     *
     * @return array
     */
    public function synchronize(): array
    {
        $feedback = [];

        foreach (config('filesystems.route_types') as $routeType) {
            $feedback[] = $this->synchronizeDBRoutes($routeType);
            $feedback[] = $this->synchronizeFile($routeType);
        }

        return $feedback;
    }

    /**
     * Make the route accessible for the group members
     *
     * @param array $data
     * @return mixed
     */
    public function attachRouteToGroup(array $data)
    {
        list($validatedDataRoute, $validatedDataGroup) = $this->validateRouteGroup($data);

        if ($validatedDataRoute === true && $validatedDataGroup === true) {
            list($route, $group) = $this->fetchRouteAndGroup($data);
            $group->routes()->attach($route->id);

            $this->attachMiddlewareToRoute($route, $data['title']);

            return true;
        }

        return $this->processRouteGroupValidation($validatedDataRoute, $validatedDataGroup);
    }

    /**
     * Remove the provided route accessibility for the group members
     *
     * @param $data
     * @return mixed
     */
    public function detachRouteFromGroup(array $data)
    {
        list($validatedDataRoute, $validatedDataGroup) = $this->validateRouteGroup($data);

        if ($validatedDataRoute === true && $validatedDataGroup === true) {
            list($route, $group) = $this->fetchRouteAndGroup($data);
            $group->routes()->detach($route->id);

            $this->detachMiddlewareFromRoute($route, $data['title']);

            return true;
        }

        return $this->processRouteGroupValidation($validatedDataRoute, $validatedDataGroup);
    }

    /**
     * Check for route collision in the appropriate route file
     *
     * @param array $fileContent
     * @param string $routeName
     * @return bool
     */
    public function checkForExistingRoute(array $fileContent, string $routeName): bool
    {
        foreach ($fileContent as $row) {
            if ($row) {
                $posMiddleware = strpos($row, '->middleware');
                $currentRouteName = $this->extractRouteName($posMiddleware, $row);

                if ($routeName === $currentRouteName) {
                    return true;
                }
            }
        }

        return false;
    }

    /**
     * Get the routes from the required route file
     *
     * @param string $routeType
     * @return array
     */
    public function getRoutes(string $routeType = ''): array
    {
        if($routeType !== '') {
            return file($this->getRoutePath($routeType), FILE_IGNORE_NEW_LINES);
        }

        $routeTypes = [
            'web',
            'page',
            'api',
            'admin',
        ];
        $rotesData = [];

        foreach ($routeTypes as $routeType) {
            $rotesData = array_merge(
                file($this->getRoutePath($routeType), FILE_IGNORE_NEW_LINES),
                $rotesData
            );
        }

        return $rotesData;
    }

    /**
     * Attach a middleware to route in the route file
     *
     * @param Route $route
     * @param string $groupTitle
     * @return void
     */
    protected function attachMiddlewareToRoute(Route $route, string $groupTitle): void
    {
        $routesFileContent = $this->getRoutes($route->route_type);
        $routeName = $route->name;
        $countRows = count($routesFileContent);

        for ($index = 0; $index < $countRows; $index++) {
            $line = $routesFileContent[$index];
            $posMiddleware = strpos($line, '->middleware');
            $currentRouteName = $this->extractRouteName($posMiddleware, $line);

            if ($currentRouteName === $routeName && $posMiddleware !== false) {
                $routesFileContent[$index] = substr_replace(
                    $routesFileContent[$index],
                    ", '$groupTitle');",
                    strlen($routesFileContent[$index]) - 2
                );
            } elseif ($currentRouteName === $routeName) {
                $routesFileContent[$index] = substr_replace(
                    $routesFileContent[$index],
                    "->middleware('$groupTitle');",
                    strlen($routesFileContent[$index]) - 1
                );
            }
        }

        $routesFileContent = implode("\n", $routesFileContent);
        file_put_contents($this->getRoutePath($route->route_type), $routesFileContent);
    }

    /**
     * Detach a middleware from route in the route file
     *
     * @param Route $route
     * @return void
     */
    protected function detachMiddlewareFromRoute(Route $route): void
    {
        $routesFileContent = $this->getRoutes($route->route_type);
        $routeName = $route->name;
        $countRows = count($routesFileContent);

        $replacement = '';
        $routeRepository = resolve(RouteRepositoryInterface::class);
        $groupsTitles = $routeRepository->getRouteGroupsTitles($route)->toArray();

        if($routeRepository->getTheRouteGroupsCount($route)) {
            $groupsTitlesString = '';
            $groupsTitlesCount = count($groupsTitles);
            for ($i = 1; $i <= $groupsTitlesCount; $i++) {
                $groupsTitlesString .= "'" . $groupsTitles[$i - 1]->title . "'";
                if($i < $groupsTitlesCount) {
                    $groupsTitlesString .= ', ';
                }
            }

            $replacement = "->middleware($groupsTitlesString)";
        }


        for ($index = 0; $index < $countRows; $index++) {
            $line = $routesFileContent[$index];
            $posMiddleware = strpos($line, '->middleware');
            $currentRouteName = $this->extractRouteName($posMiddleware, $line);

            if ($currentRouteName === $routeName) {
                preg_match('/->middleware\(.+\)/', $routesFileContent[$index], $replaced);

                $routesFileContent[$index] = str_replace($replaced, $replacement, $routesFileContent[$index]);
            }
        }

        $routesFileContent = implode("\n", $routesFileContent);
        file_put_contents($this->getRoutePath($route->route_type), $routesFileContent);
    }

    /**
     * Write a route in a route file
     *
     * @param array $routeData
     * @return bool
     */
    protected function writeRoute(array $routeData): bool
    {
        $routeFileData = $this->getRoutes($routeData['route_type']);

        if (! $this->checkForExistingRoute($routeFileData, $routeData['name'])) {
            $this->addRouteToFile($routeData);

            return true;
        }

        return false;
    }

    /**
     * Erase a route from the route file if it exists
     *
     * @param Route $route
     * @return void
     */
    protected function eraseRoute(Route $route): void
    {
        $routesArray = $this->getRoutes($route->route_type);

        if($routesArray) {
            foreach ($routesArray as $key => $routeLine) {
                if(strpos($routeLine, $route->name) !== false) {
                    break;
                }
            }

            unset($routesArray[$key]);

            file_put_contents($this->getRoutePath($route->route_type), '');

            $counter = 0;
            $routesArrayCount = count($routesArray);

            foreach ($routesArray as $line) {
                $counter++;
                if($counter < $routesArrayCount) {
                    $line = "$line\n";
                }

                file_put_contents($this->getRoutePath($route->route_type), $line, FILE_APPEND);
            }
        }
    }

    /**
     * Get the path to the route file
     *
     * @param string $routeType
     * @return string
     */
    protected function getRoutePath(string $routeType): string
    {
        return base_path(). '/routes/' . $routeType . '.php';
    }

    /**
     * Create a route string from the stored route data
     *
     * @param array $routeData
     * @return string
     */
    protected function createRouteString(array $routeData): string
    {
        return "\n    Route::" .
            $routeData['method'] .
            "('" .
            $routeData['url'] .
            "', '" .
            $routeData['action'] .
            "')->name('" .
            $routeData['name'] .
            "');\n" .
            '});';
    }

    /**
     * Synchronize routes for a route file
     *
     * @param string $routeType
     * @return array
     */
    protected function synchronizeFile(string $routeType): array
    {
        $routes = $this->getRoutes($routeType);

        $feedback = [];

        foreach ($routes as $route) {
            $posMiddleware = strpos($route, '->middleware');
            $routeName = $this->extractRouteName($posMiddleware, $route);

            if($routeName &&
                ($method = $this->getRouteSubstr(
                    $route,
                    '/[a-z]*\(/',
                    '('
                )) &&
                ($url = $this->getRouteSubstr(
                    $route,
                    "/Route::[a-z]+\('[\/a-zA-Z0-9{}]+'/",
                    "'"
                )) &&
                ($action = $this->getRouteSubstr(
                    $route,
                    "/Route::[a-z]+\('[\/a-zA-Z0-9{}]+'.+'[a-zA-Z\\\@0-9')]+->name/",
                    "'"
                )) &&
                ! Route::where('name', $routeName)->first()
            ) {
                $route = Route::create([
                    'method' => $method,
                    'url' => $url,
                    'action' => $action,
                    'name' => $routeName,
                    'route_type' => $routeType,
                ]);

                $feedback[] = $this->synchronizedRouteFeedback($route, 'DB');
            }
        }

        return $feedback;
    }

    /**
     * Get a key part of the route string
     *
     * @param string $route
     * @param string $regex
     * @param string $delimiter
     * @return bool|mixed
     */
    protected function getRouteSubstr(string $route, string $regex, string $delimiter)
    {
       preg_match($regex, $route, $result);

        if(isset($result[0])) {
            $routeArr = explode($delimiter, $result[0]);
            array_pop($routeArr);

            return end($routeArr);
        }

        return false;
    }

    /**
     * If a route is stored in DB but is missing in the route files,
     * the method writes it in a route file
     *
     * @param string $routeType
     * @return array
     */
    protected function synchronizeDBRoutes(string $routeType): array
    {
        $dbRoutes = Route::where('route_type', $routeType)->get();

        $fileRoutes = $this->getRoutes($routeType);

        $fileRouteNames = $this->getFileRouteNames($fileRoutes);

        $feedback = [];

        foreach ($dbRoutes as $dbRoute) {
            if (! array_key_exists($dbRoute->name, $fileRouteNames)) {
                $this->writeRoute($dbRoute->toArray());
                $feedback[] = $this->synchronizedRouteFeedback($dbRoute, $dbRoute->route_type . '.php');
            }
        }

        return $feedback;
    }

    /**
     * Get the names of all routes in a route file
     *
     * @param array $routes
     * @return array
     */
    protected function getFileRouteNames(array $routes): array
    {
        $fileRouteNames = [];

        foreach ($routes as $route) {
            $posMiddleware = strpos($route, '->middleware');
            $fileRouteNames[] = $this->extractRouteName($posMiddleware, $route);
        }

        return $fileRouteNames;
    }

    /**
     * Create a feedback for a synchronized route
     *
     * @param Route $route
     * @return string
     */
    protected function synchronizedRouteFeedback(Route $route, string $location): string
    {
        return 'A route with name ' . $route->name .
            ', url ' . $route->url .
            ', action ' . $route->action .
            ' is stored in ' . $location . '.';
    }

    /**
     * Get the route name from string
     *
     * @param $posMiddleware
     * @param $line
     * @return bool|mixed
     */
    protected function extractRouteName($posMiddleware, string $line)
    {
        if ($posMiddleware !== false) {
            $lineArr = explode('->', $line);

            return explode("'", $lineArr[count($lineArr) - 2])[1];
        }

        return $this->getRouteSubstr(
            $line,
            "/->name\('.+'/",
            "'"
        );
    }

    /**
     * Validate the route name and the group title
     *
     * @param array $data
     * @return array
     */
    protected function validateRouteGroup(array $data): array
    {
        $validatedDataRoute = $this->validationService->validate(
            $data,
            ['name'],
            'route',
            'exists'
        );
        $validatedDataGroup = $this->validationService->validate(
            $data,
            ['title'],
            'group',
            'exists'
        );
        return array($validatedDataRoute, $validatedDataGroup);
    }

    /**
     * Process the result of route name and group title validation
     *
     * @param $validatedDataRoute
     * @param $validatedDataGroup
     * @return array
     */
    protected function processRouteGroupValidation($validatedDataRoute, $validatedDataGroup): array
    {
        $result = [];

        if (is_array($validatedDataRoute)) {
            array_merge($result, $validatedDataRoute);
        }

        if (is_array($validatedDataGroup)) {
            array_merge($result, $validatedDataGroup);
        }

        return $result;
    }

    /**
     * Fetch route and group
     *
     * @param array $data
     * @return array
     */
    protected function fetchRouteAndGroup(array $data): array
    {
        $route = Route::where('name', $data['name'])->first();
        $group = Group::where('title', $data['title'])->first();

        return [$route, $group];
    }

    /**
     * Add prefix to the route action which is related to controller folder
     *
     * @param string $action
     * @param string $actionType
     * @return string
     */
    protected function processAction(string $action, string $actionType): string
    {
        if(! $actionType) {
            $actionType = 'front';
        }

        return ucfirst($actionType) . '\\' . $action;
    }

    /**
     * Add a route to file
     *
     * @param array $routeData
     */
    protected function addRouteToFile(array $routeData): void
    {
        $routesArray = $this->getRoutes($routeData['route_type']);
        $routesCount = count($routesArray) - 1;

        for ($i = $routesCount; $i > 0; $i--) {
            if($routesArray[$i] === '});') {
                unset($routesArray[$i]);
                break;
            }
        }

        file_put_contents($this->getRoutePath($routeData['route_type']), '');

        $counter = 1;


        foreach ($routesArray as $line) {
            if($counter !== $routesCount) {
                $line .= "\n";
            }
            file_put_contents($this->getRoutePath($routeData['route_type']), $line, FILE_APPEND);
            $counter ++;
        }

        file_put_contents($this->getRoutePath(
            $routeData['route_type']),
            $this->createRouteString($routeData),
            FILE_APPEND
        );
    }
}
