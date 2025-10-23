<?php

namespace Database\Seeders;

use App\Enums\EquipmentClass;
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
        Equipment::factory(200)->create();
        Hunter::all()->each(function ($hunter) {
            $hunter->update([
                'helmet' => Equipment::where('type', EquipmentClass::Helmet)->inRandomOrder()->first()->id,
                'vest' => Equipment::where('type', EquipmentClass::Vest)->inRandomOrder()->first()->id,
                'trousers' => Equipment::where('type', EquipmentClass::Trousers)->inRandomOrder()->first()->id,
            ]);
        });
    }
}
