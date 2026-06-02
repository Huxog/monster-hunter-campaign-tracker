<?php

namespace App\Providers;

use App\Interfaces\ICampaignRepository;
use App\Interfaces\ICampaignService;
use App\Interfaces\IEquipmentRepository;
use App\Interfaces\IEquipmentService;
use App\Interfaces\IGoogleAuthService;
use App\Interfaces\IHealthService;
use App\Interfaces\IHunterRepository;
use App\Interfaces\IHunterService;
use App\Interfaces\ILoggingService;
use App\Interfaces\IMapRepository;
use App\Interfaces\IMapService;
use App\Interfaces\IMaterialRepository;
use App\Interfaces\IMaterialService;
use App\Interfaces\IMonsterRepository;
use App\Interfaces\IMonsterService;
use App\Interfaces\IQuestRepository;
use App\Interfaces\IQuestService;
use App\Interfaces\IUserRepository;
use App\Interfaces\IWeaponRepository;
use App\Interfaces\IWeaponService;
use App\Repositories\CampaignRepository;
use App\Repositories\EquipmentRepository;
use App\Repositories\HunterRepository;
use App\Repositories\MapRepository;
use App\Repositories\MaterialRepository;
use App\Repositories\MonsterRepository;
use App\Repositories\QuestRepository;
use App\Repositories\UserRepository;
use App\Repositories\WeaponRepository;
use App\Services\CampaignService;
use App\Services\EquipmentService;
use App\Services\GoogleAuthService;
use App\Services\HealthService;
use App\Services\HunterService;
use App\Services\LoggingService;
use App\Services\MapService;
use App\Services\MaterialService;
use App\Services\MonsterService;
use App\Services\QuestService;
use App\Services\WeaponService;
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
        $this->app->bind(IEquipmentRepository::class, EquipmentRepository::class);
        $this->app->bind(IWeaponRepository::class, WeaponRepository::class);
        $this->app->bind(IMaterialRepository::class, MaterialRepository::class);
        $this->app->bind(IMonsterRepository::class, MonsterRepository::class);
        $this->app->bind(IQuestRepository::class, QuestRepository::class);
        $this->app->bind(IUserRepository::class, UserRepository::class);

        // Infrastructure bindings
        $this->app->bind(IHealthService::class, HealthService::class);
        $this->app->bind(ILoggingService::class, LoggingService::class);

        // Service bindings
        $this->app->bind(IMapService::class, MapService::class);
        $this->app->bind(ICampaignService::class, CampaignService::class);
        $this->app->bind(IHunterService::class, HunterService::class);
        $this->app->bind(IEquipmentService::class, EquipmentService::class);
        $this->app->bind(IWeaponService::class, WeaponService::class);
        $this->app->bind(IMaterialService::class, MaterialService::class);
        $this->app->bind(IMonsterService::class, MonsterService::class);
        $this->app->bind(IQuestService::class, QuestService::class);
        $this->app->bind(IGoogleAuthService::class, GoogleAuthService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
