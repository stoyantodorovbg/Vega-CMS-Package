<?php

namespace Vegacms\Cms\Console\Commands;

use Illuminate\Console\Command;
use Vegacms\Cms\Traits\CommandUtilities;
use Vegacms\Cms\Services\Interfaces\RouteServiceInterface;

class AttachRouteToGroup extends Command
{
    use CommandUtilities;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'attach:route-to-group {name} {title}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Make the route accessible for the group members';

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

        $validationData = $this->routeService->attachRouteToGroup($data);

        $this->output($validationData, 'The route is attached to the group successfully.');
    }
}
