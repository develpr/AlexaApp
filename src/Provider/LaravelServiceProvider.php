<?php

namespace Frijj2k\LarAlexa\Provider;

use Illuminate\Contracts\Http\Kernel;
use Illuminate\Support\ServiceProvider;
use ReflectionClass;

class LaravelServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            realpath(__DIR__.'/../../config/alexa.php') => config_path('alexa.php'),
        ], 'config');

        $this->publishes([
            realpath(__DIR__.'/../../database/2015_06_21_000000_create_alexa_devices_table.php') => database_path('/migrations/2015_06_21_000000_create_alexa_devices_table.php'),
        ], 'migrations');
    }

    /**
     * Register the service provider.
     */
    public function register()
    {
        $this->setupConfig();

        /** @var \App\Http\Kernel $kernel */
        $kernel = $this->app->make('Illuminate\Contracts\Http\Kernel');

        $this->app->instance('alexa.router.middleware', $this->gatherAppMiddleware($kernel));

        // Register our universal service provider
        $this->app->register('Frijj2k\LarAlexa\Provider\AlexaServiceProvider');

        $this->addRequestMiddlewareToBeginning($kernel);
    }

    protected function setupConfig()
    {
        $this->mergeConfigFrom(realpath(__DIR__.'/../../config/alexa.php'), 'alexa');
    }

    protected function addRequestMiddlewareToBeginning(Kernel $kernel)
    {
        /** @var \App\Http\Kernel $kernel */
        $kernel->prependMiddleware('Frijj2k\LarAlexa\Http\Middleware\Request');
    }

    /**
     * Gather the application middleware besides this one so that we can send
     * our request through them, exactly how the developer wanted.
     *
     * @param \Illuminate\Contracts\Http\Kernel $kernel
     *
     * @return array
     */
    protected function gatherAppMiddleware(Kernel $kernel)
    {
        $reflection = new ReflectionClass($kernel);

        $property = $reflection->getProperty('middleware');
        $property->setAccessible(true);

        $middleware = $property->getValue($kernel);

        if ($this->app['config']['alexa.skipCsrfCheck']) {
            $middleware = $this->unsetCsrfMiddleware($middleware);
        }

        return $middleware;
    }

    private function unsetCsrfMiddleware($allMiddleware)
    {
        foreach ($allMiddleware as $position => $aMiddleware) {
            if (strpos(strtolower($aMiddleware), 'verifycsrftoken') !== false) {
                unset($allMiddleware[$position]);
                break;
            }
        }

        return $allMiddleware;
    }
}
