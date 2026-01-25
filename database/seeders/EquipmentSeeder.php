<?php

namespace Database\Seeders;

use App\Enums\EquipmentType;
use App\Models\Equipment;
use App\Models\Hunter;
use Illuminate\Database\Seeder;

class EquipmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Equipment::factory(120)->create();
        Hunter::all()->each(function (Hunter $hunter) {
            $hunter->helmetId = Equipment::where('type', EquipmentType::Helmet)->inRandomOrder()->first()->id;
            $hunter->vestId = Equipment::where('type', EquipmentType::Vest)->inRandomOrder()->first()->id;
            $hunter->trousersId = Equipment::where('type', EquipmentType::Trouser)->inRandomOrder()->first()->id;
            $hunter->save();
        });
    }
}
