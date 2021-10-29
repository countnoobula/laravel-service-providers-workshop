<?php

namespace App\Modules\UserExporter;

use App\Modules\UserExporter\UserExporterEngine;
use Illuminate\Support\ServiceProvider;
use View;

class UserExporterServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     * - Register the Export Facade & Export Singleton
     * 
     * @return void
     */
    public function register()
    {
        // Previously call like app()->make(ClassName::class)->method()
        // With Facade call like UserExport::method()
        $this->app->singleton('user-exporter', function () {
            return new UserExporterEngine();
        });
    }

    /**
     * Bootstrap any application services.
     * - Register View namespace.
     * - Register View Composers
     *
     * @return void
     */
    public function boot()
    {
        // Call it like `UserExport::show`
        View::addNamespace('UserExporter', __DIR__ . '/Views');

        View::composer('UserExporter::show', function ($view) {
            $view->with([
                'type' => request()->input('type') ?? UserExporterEngine::TYPE_CSV,
            ]);
        });
    }
}
