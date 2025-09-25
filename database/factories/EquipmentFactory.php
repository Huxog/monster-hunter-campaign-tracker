<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Hunter;

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
            'effect' => fake()->sentence(),
            'type' => fake()->randomElement(['Helmet', 'Vest', 'Trousers']),
            'armor' => fake()->numberBetween(0, 5),
            'elementalResistance' => fake()->randomElement(['fire', 'water', 'thunder', 'ice', 'dragon', null]),
            'elementalResistanceValue' => fake()->numberBetween(1, 5),
            'class' => fake()->randomElement(['Bow', 'Dual Blades', 'Sword and Shield', 'Great Sword']),
        ];
    }
}
