<?php

namespace Vegacms\Cms\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
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
    protected $signature = 'integrate:vega-cms';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Integrate Vega CMS to laravel framework';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle(): void
    {
        // Add main layout
        $fileService = resolve(FileCreateServiceInterface::class);

        $fileService->createFile(
            '/resources/views/',
            'app',
            '.blade.php',
            __DIR__ . '/../../../Stubs/app.stub',
            false
        );
        $this->info('Main layout added.');

        // Add routes
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
        $fileService->createFile(
            '/routes/',
            'vega-api',
            '.php',
            __DIR__ . '/../../../Stubs/vega-api.stub',
            false
        );
        $fileService->createFile(
            '/routes/',
            'vega-web',
            '.php',
            __DIR__ . '/../../../Stubs/vega-web.stub',
            false
        );
        $this->info('Vega CMS routes added.');

        File::delete('/app/Providers/AppServiceProvider.php');
        $fileService->createFile(
            '/app/Providers/',
            'AppServiceProvider',
            '.php',
            __DIR__ . '/../../../Stubs/AppServiceProvider.stub',
            false
        );
        $this->info('Vega CMS RouteServiceProvider added.');

        shell_exec('mkdir ' . base_path() . '/app/Traits');

        // Add DataRepositoryTrait
        $fileService->createFile(
            '/app/Traits/',
            'DataRepositoryTrait',
            '.php',
            __DIR__ . '/../../../Stubs/data-repository-trait.stub',
            false
        );
        $this->info('DataRepositoryTrait added.');

        // Migrate DB
        Artisan::call('migrate');
        $this->info('Database migrated.');

        // Publish front-end assets
        Artisan::call('vendor:publish --tag=vegacms-assets-js --force');
        $this->info('Published JS assets.');

        Artisan::call('vendor:publish --tag=vegacms-assets-sass --force');
        $this->info('SCSS assets published.');

        Artisan::call('vendor:publish --tag=vegacms-config --force');
        $this->info('Config file published.');

        // Install JS dependencies
        shell_exec('npm install --save vue vuex');
        shell_exec('npm i laravel-vue-pagination');
        shell_exec('npm install vue-pluralize');
        shell_exec('npm i bootstrap-vue');
        shell_exec('npm i @fortawesome/fontawesome-free');
        shell_exec('npm install --save jquery');
        $this->info('JS libraries added.');

        // Install SASS Loader
        shell_exec('npm install sass-loader --save-dev');
        $this->info('SASS Loader installed.');

        // Include front-end assets
        file_put_contents(
            base_path() . '/resources/js/app.js',
            'require(\'../assets/js/app.js\');',
            FILE_APPEND
        );
        file_put_contents(
            base_path() . '/resources/css/app.css',
            '@import \'../assets/sass/app.scss\';',
            FILE_APPEND
        );
        $this->info('Assets included.');

        $fileService->createFile(
            '/',
            'webpack.mix',
            '.js',
            __DIR__ . '/../../../Stubs/webpack-mix.stub',
            false
        );
        $this->info('webpack-mix.js configured.');

        // Transpile front-end assets
        shell_exec('npm run watch');
    }
}
