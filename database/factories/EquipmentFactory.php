<?php

namespace Database\Factories;

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
                'fire' => fake()->numberBetween(0, 5),
                'ice' => fake()->numberBetween(0, 5),
                'thunder' => fake()->numberBetween(0, 5),
                'water' => fake()->numberBetween(0, 5),
                'dragon' => fake()->numberBetween(0, 5),
            ],
            'class' => fake()->optional()->randomElement(WeaponClass::cases()),
        ];
    }
}
