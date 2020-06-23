<?php

namespace Vegacms\Cms\Console\Commands;

use Illuminate\Console\Command;
use Vegacms\Cms\Traits\CommandUtilities;
use Vegacms\Cms\Services\Interfaces\GroupServiceInterface;

class DestroyGroup extends Command
{
    use CommandUtilities;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'destroy:group {title}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Destroy a route';

    /**
     * @var GroupServiceInterface
     */
    protected $groupService;

    /**
     * Create a new controller creator command instance.
     *
     * @param GroupServiceInterface $groupService
     */
    public function __construct(GroupServiceInterface $groupService)
    {
        parent::__construct();

        $this->groupService = $groupService;
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle(): void
    {
        $data = $this->processArguments();

        $validationData = $this->groupService->destroy($data);

        $this->output($validationData, 'The group is destroyed.');
    }
}
