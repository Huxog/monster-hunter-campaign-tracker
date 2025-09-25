<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Equipment;
use App\Models\Hunter;
use App\Enums\EquipmentClass;

class EquipmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Equipment::factory(200)->create();
        Hunter::all()->each(function ($campaign) {
            $campaign->update([
                'helmet' => Equipment::where("type",EquipmentClass::Helmet)->inRandomOrder()->first()->id,
                'vest' => Equipment::where("type",EquipmentClass::Vest)->inRandomOrder()->first()->id,
                'trousers' => Equipment::where("type",EquipmentClass::Trousers)->inRandomOrder()->first()->id,
            ]);
        });
    }
}
