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
            MapSeeder::class,
            WeaponSeeder::class,
            EquipmentSeeder::class,
            CampaignSeeder::class,
            HunterSeeder::class,
        ]);
    }
}
