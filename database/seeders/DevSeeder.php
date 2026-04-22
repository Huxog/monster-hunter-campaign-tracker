<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DevSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            MapSeeder::class,
            WeaponSeeder::class,
            EquipmentSeeder::class,
            CampaignSeeder::class,
            HunterSeeder::class,
            MaterialSeeder::class,
            MonsterSeeder::class,
            QuestSeeder::class,
        ]);
    }
}
