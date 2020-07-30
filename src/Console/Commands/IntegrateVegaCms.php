<?php

namespace Vegacms\Cms\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Vegacms\Cms\Traits\CommandUtilities;
use Vegacms\Cms\Services\Interfaces\FileCreateServiceInterface;

class IntegrateVegaCms extends Command
{
    use CommandUtilities;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'integrate:vegacms-cms';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Integrate Vegacms CMS to laravel framework';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle(): void
    {
        // Add routes
        $fileService = resolve(FileCreateServiceInterface::class);
        $fileService->createFile(
            '/routes/',
            'admin',
            '.php',
            __DIR__ . '/../../../Stubs/admin.stub',
            false
        );
        $fileService->createFile(
            '/routes/',
            'page',
            '.php',
            __DIR__ . '/../../../Stubs/page.stub',
            false
        );
        shell_exec('rm /routes.api.php');
        $fileService->createFile(
            '/routes/',
            'api',
            '.php',
            __DIR__ . '/../../../Stubs/api.stub',
            false
        );
        shell_exec('rm /routes.web.php');
        $fileService->createFile(
            '/routes/',
            'web',
            '.php',
            __DIR__ . '/../../../Stubs/web.stub',
            false
        );
        $this->info('Vega CMS routes added.');

        // Migrate DB
        Artisan::call('migrate');
        $this->info('Database migrated.');

        // Publish fron-end assets
        Artisan::call('vendor:publish --tag=vegacms-assets-js --force');
        $this->info('Config file published.');

        Artisan::call('vendor:publish --tag=vegacms-config --force');
        $this->info('Published JS assets');

        Artisan::call('vendor:publish --tag=vegacms-assets-sass --force');
        $this->info('SCSS assets published.');

        // Install JS dependencies
        shell_exec('npm install --save vue vuex');
        shell_exec('npm i laravel-vue-pagination');
        shell_exec('npm install vue-pluralize');
        shell_exec('npm i bootstrap-vue');
        shell_exec('npm i @fortawesome/fontawesome-free');
        shell_exec('npm install --save jquery');
        $this->info('JS libraries added.');

        // Include front-end assets
        file_put_contents(
            base_path() . '/resources/js/app.js',
            'require(\'../assets/js/app.js\');',
            FILE_APPEND
        );
        file_put_contents(
            base_path() . '/resources/sass/app.scss',
            '@import \'../assets/sass/app.scss\';',
            FILE_APPEND
        );
        $this->info('Assets included.');

        // Transpile front-end assets
        shell_exec('npm run watch');
    }
}
