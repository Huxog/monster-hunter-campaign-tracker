<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        self::call([
            RolePermissionSeeder::class,
            AdminUserSeeder::class,
            MapSeeder::class,
            WeaponSeeder::class,
            EquipmentSeeder::class,
            CampaignSeeder::class,
            HunterSeeder::class,
            MaterialSeeder::class,
        ]);
    }
}
