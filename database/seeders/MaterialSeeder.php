<?php

namespace Database\Seeders;

use App\Models\Equipment;
use App\Models\Hunter;
use App\Models\Material;
use App\Models\Weapon;
use Illuminate\Database\Seeder;

class MaterialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->seedMaterials();
        $this->seedHunterInventories();
        $this->seedWeaponRecipes();
        $this->seedEquipmentRecipes();
    }

    private function seedMaterials(): void
    {
        $materials = [
            // Bones
            'Monster Bone S',
            'Monster Bone M',
            'Monster Bone L',
            'Monster Bone+',
            'Heavy Bone',
            'Dragonbone Relic',
            'Fierce Dragonbone',
            // Rathalos
            'Rathalos Scale',
            'Rathalos Shell',
            'Rathalos Wing',
            'Rathalos Tail',
            'Rathalos Webbing',
            'Rathalos Plate',
            'Rathalos Ruby',
            // Rathian
            'Rathian Scale',
            'Rathian Shell',
            'Rathian Wing',
            'Rathian Spike',
            'Rathian Plate',
            'Rathian Ruby',
            // Nargacuga
            'Nargacuga Fur',
            'Nargacuga Scale',
            'Nargacuga Claw',
            'Nargacuga Tail',
            'Nargacuga Plate',
            'Swift Fang',
            // Tigrex
            'Tigrex Scale',
            'Tigrex Shell',
            'Tigrex Claw',
            'Tigrex Fang',
            'Tigrex Tail',
            'Tigrex Plate',
            // Zinogre
            'Zinogre Scale',
            'Zinogre Shell',
            'Zinogre Claw',
            'Zinogre Tail',
            'Zinogre Horn',
            'Zinogre Plate',
            'Zinogre Ruby',
            // Diablos
            'Diablos Scale',
            'Diablos Shell',
            'Diablos Horn',
            'Diablos Tailblade',
            'Diablos Carapace',
            'Diablos Plate',
            // Ores and gathering
            'Iron Ore',
            'Machalite Ore',
            'Dragonite Ore',
            'Carbalite Ore',
            'Fucium Ore',
            'Firecell Stone',
            'Lightcrystal',
            // Bugs and herbs
            'Herb',
            'Antidote Herb',
            'Fire Herb',
            'Ice Crystal',
            'Flashbug',
            'Thunderbug',
            'Godbug',
            'Bitterbug',
            // Generic drops
            'Wyvern Claw',
            'Wyvern Fang',
            'Wyvern Tear',
            'Wyvern Gem',
            'Dragon Scale',
            'Dragon Bone',
            'Elder Dragon Blood',
            'Elder Dragon Gem',
        ];

        foreach ($materials as $name) {
            Material::firstOrCreate(['name' => $name]);
        }
    }

    /**
     * Give each hunter a random selection of materials in their inventory.
     */
    private function seedHunterInventories(): void
    {
        $materials = Material::all();

        Hunter::all()->each(function (Hunter $hunter) use ($materials) {
            $subset = $materials->random(rand(3, 8));

            $pivot = $subset->mapWithKeys(fn ($material) => [
                $material->id => ['quantity' => rand(1, 10)],
            ])->all();

            $hunter->loot()->syncWithoutDetaching($pivot);
        });
    }

    /**
     * Assign crafting material requirements to each weapon.
     */
    private function seedWeaponRecipes(): void
    {
        $materials = Material::all();

        Weapon::all()->each(function (Weapon $weapon) use ($materials) {
            $subset = $materials->random(rand(2, 5));

            $pivot = $subset->mapWithKeys(fn ($material) => [
                $material->id => ['quantity' => rand(1, 3)],
            ])->all();

            $weapon->materials()->syncWithoutDetaching($pivot);
        });
    }

    /**
     * Assign crafting material requirements to each equipment piece.
     */
    private function seedEquipmentRecipes(): void
    {
        $materials = Material::all();

        Equipment::all()->each(function (Equipment $equipment) use ($materials) {
            $subset = $materials->random(rand(2, 5));

            $pivot = $subset->mapWithKeys(fn ($material) => [
                $material->id => ['quantity' => rand(1, 3)],
            ])->all();

            $equipment->materials()->syncWithoutDetaching($pivot);
        });
    }
}
