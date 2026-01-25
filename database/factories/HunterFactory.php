<?php

namespace Database\Factories;

use App\Enums\EquipmentType;
use App\Models\Campaign;
use App\Models\Equipment;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Hunter>
 */
class HunterFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'playerName' => fake()->name(),
            'hunterName' => fake()->word(),
            'campaignId' => Campaign::factory(),
        ];
    }

    /**
     * Equip a helmet.
     */
    public function withHelmet(): static
    {
        return $this->state(fn (array $attributes) => [
            'helmet' => Equipment::factory()->state(['type' => EquipmentType::Helmet]),
        ]);
    }

    /**
     * Equip a vest.
     */
    public function withVest(): static
    {
        return $this->state(fn (array $attributes) => [
            'vest' => Equipment::factory()->state(['type' => EquipmentType::Vest]),
        ]);
    }

    /**
     * Equip trousers.
     */
    public function withTrousers(): static
    {
        return $this->state(fn (array $attributes) => [
            'trousers' => Equipment::factory()->state(['type' => EquipmentType::Trouser]),
        ]);
    }

    /**
     * Fully equipped with all armor pieces.
     */
    public function fullyEquipped(): static
    {
        return $this->withHelmet()->withVest()->withTrousers();
    }
}
