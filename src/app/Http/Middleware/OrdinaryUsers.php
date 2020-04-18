<?php

namespace App\Http\Middleware;

use Closure;
use ReflectionClass;
use ReflectionException;
use Illuminate\Http\Request;
use App\Services\Interfaces\GroupServiceInterface;
use Illuminate\Cookie\Middleware\EncryptCookies as Middleware;

class OrdinaryUsers extends Middleware
{
    /**
    * @var GroupServiceInterface
    */
    protected $groupService;

    /**
    * Handle an incoming request.
    *
    * @param  Request  $request
    * @param Closure $next
    * @return mixed
    * @throws ReflectionException
    */
    public function handle($request, Closure $next)
    {
        if (! auth()->check()) {
            if($request->expectsJson()) {
                return response()->json(['error' => 'Unauthenticated.'], 401);
            }

            return redirect(route('login', [], false));
        }

        $reflect = new ReflectionClass($this);
        $groupName = strtolower($reflect->getShortName());

        if(! resolve(GroupServiceInterface::class)->userHasGroup(auth()->user(), $groupName)) {
            if($request->expectsJson()) {
                return response()->json(['error' => 'Unauthenticated.'], 401);
            }

            return redirect(route('welcome', [], false));
        }

        return $next($request);
    }
}
