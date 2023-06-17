<?php

namespace Mostafaznv\NovaLaraCache;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Laravel\Nova\Nova;
use Illuminate\Support\ServiceProvider;
use Mostafaznv\NovaLaraCache\Http\Middleware\Authorize;

class NovaLaraCacheServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../lang/' => resource_path('lang/vendor/nova-laracache'),
            ]);
        }

        $this->app->booted(function() {
            $this->routes();
        });

        $this->translations();

        Nova::serving(function() {
            $this->assets();
            $this->loadTranslationsToNova();
        });
    }

    private function routes(): void
    {
        if ($this->app->routesAreCached()) {
            return;
        }

        $path = Str::finish(config('nova.path'), '/');

        Route::middleware(['nova', Authorize::class])
            ->prefix($path . 'laracache')
            ->group(__DIR__ . '/../routes/inertia.php');


        Route::middleware(['nova:api', Authorize::class])
            ->prefix('nova-vendor/nova-laracache')
            ->group(__DIR__ . '/../routes/api.php');
    }

    private function assets(): void
    {
        Nova::script('nova-laracache', __DIR__ . '/../dist/js/tool.js');
        Nova::style('nova-laracache', __DIR__ . '/../dist/css/tool.css');
    }

    private function translations(): void
    {
        $this->loadTranslationsFrom(__DIR__ . '/../lang', 'nova-laracache');
        $this->loadJsonTranslationsFrom(__DIR__ . '/../lang');
    }

    private function loadTranslationsToNova(): void
    {
        $translations = trans('nova-laracache::ui');

        if (!is_array($translations)) {
            $translations = [];
        }

        $translations = array_merge(trans('nova-laracache::ui', [], 'en'), $translations);

        Nova::translations($translations);
    }
}
