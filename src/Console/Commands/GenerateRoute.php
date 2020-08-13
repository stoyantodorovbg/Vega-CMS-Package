<?php

namespace Vegacms\Cms\Console\Commands;

use Illuminate\Console\Command;
use Vegacms\Cms\Traits\CommandUtilities;
use Vegacms\Cms\Services\Interfaces\RouteServiceInterface;

class GenerateRoute extends Command
{
    use CommandUtilities;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:route {url} {method} {action} {name} {route_type=vega-web} {action_type=front} {controller_namespace=null}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate a route';

    /**
     * @var RouteServiceInterface
     */
    protected $routeService;

    /**
     * Create a new command instance.
     *
     * @param RouteServiceInterface $routeService
     */
    public function __construct(RouteServiceInterface $routeService)
    {
        parent::__construct();

        $this->routeService = $routeService;
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle(): void
    {
        $data = $this->processArguments();

        $validationData = $this->routeService->create($data);

        $this->output($validationData, 'The route is generated successfully.');
    }
}
