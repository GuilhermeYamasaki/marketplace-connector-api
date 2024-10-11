<?php

namespace App\Providers\Services;

use App\Services\Interfaces\OfferServiceInterface;
use App\Services\OfferService;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class OfferServiceProvider extends ServiceProvider implements DeferrableProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(OfferServiceInterface::class, OfferService::class);
    }

    /**
     * @return string[]
     */
    public function provides()
    {
        return [
            OfferServiceInterface::class,
        ];
    }
}
