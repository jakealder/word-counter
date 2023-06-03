<?php

namespace App\Providers;

use App\HtmlParser\HtmlParserManager;
use Illuminate\Support\ServiceProvider;

class HtmlParserServiceProvider extends ServiceProvider
{

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected bool $defer = true;

    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton('htmlparser', function ($app) {
            return new HtmlParserManager($app);
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides(): array {
        return ['htmlparser'];
    }
}
