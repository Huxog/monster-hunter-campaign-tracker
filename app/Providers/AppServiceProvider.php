<?php

namespace App\Providers;

use App\Interfaces\ICampaignRepository;
use App\Interfaces\IHunterRepository;
use App\Interfaces\IMapRepository;
use App\Interfaces\ICampaignService;
use App\Interfaces\IHunterService;
use App\Interfaces\IMapService;
use App\Repositories\CampaignRepository;
use App\Repositories\HunterRepository;
use App\Repositories\MapRepository;
use App\Services\CampaignService;
use App\Services\HunterService;
use App\Services\MapService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Repository bindings
        $this->app->bind(IMapRepository::class, MapRepository::class);
        $this->app->bind(ICampaignRepository::class, CampaignRepository::class);
        $this->app->bind(IHunterRepository::class, HunterRepository::class);

        // Service bindings
        $this->app->bind(IMapService::class, MapService::class);
        $this->app->bind(ICampaignService::class, CampaignService::class);
        $this->app->bind(IHunterService::class, HunterService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
