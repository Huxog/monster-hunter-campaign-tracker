<?php

namespace Database\Factories;

use App\Enums\ElementalType;
use App\Enums\EquipmentType;
use App\Enums\WeaponClass;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Equipment>
 */
class EquipmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->word(),
            'effect' => fake()->optional()->sentence(),
            'type' => fake()->randomElement(EquipmentType::cases()),
            'armor' => fake()->numberBetween(0, 5),
            'elementalResistances' => [
                ElementalType::Fire->value => fake()->numberBetween(0, 5),
                ElementalType::Water->value => fake()->numberBetween(0, 5),
                ElementalType::Thunder->value => fake()->numberBetween(0, 5),
                ElementalType::Ice->value => fake()->numberBetween(0, 5),
                ElementalType::Dragon->value => fake()->numberBetween(0, 5),
            ],
            'class' => fake()->randomElement(WeaponClass::cases()),
        ];
    }
}
