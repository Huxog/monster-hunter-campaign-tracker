<?php

namespace Database\Factories;

use App\Enums\EquipmentType;
use App\Enums\WeaponClass;
use App\Models\Campaign;
use App\Models\Equipment;
use App\Models\Weapon;
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
            'class' => fake()->randomElement(WeaponClass::cases()),
        ];
    }

    /**
     * Set a specific weapon class for the hunter.
     */
    public function withClass(WeaponClass $class): static
    {
        return $this->state(fn (array $attributes) => [
            'class' => $class,
        ]);
    }

    /**
     * Equip a helmet matching the hunter's class.
     */
    public function withHelmet(): static
    {
        return $this->state(fn (array $attributes) => [
            'helmetId' => Equipment::factory()->state([
                'type' => EquipmentType::Helmet,
                'class' => $attributes['class'],
            ]),
        ]);
    }

    /**
     * Equip a vest matching the hunter's class.
     */
    public function withVest(): static
    {
        return $this->state(fn (array $attributes) => [
            'vestId' => Equipment::factory()->state([
                'type' => EquipmentType::Vest,
                'class' => $attributes['class'],
            ]),
        ]);
    }

    /**
     * Equip trousers matching the hunter's class.
     */
    public function withTrousers(): static
    {
        return $this->state(fn (array $attributes) => [
            'trousersId' => Equipment::factory()->state([
                'type' => EquipmentType::Trouser,
                'class' => $attributes['class'],
            ]),
        ]);
    }

    /**
     * Equip a weapon matching the hunter's class.
     */
    public function withWeapon(): static
    {
        return $this->state(fn (array $attributes) => [
            'weaponId' => Weapon::factory()->state([
                'class' => $attributes['class'],
            ]),
        ]);
    }

    /**
     * Fully equipped with all armor pieces and weapon.
     */
    public function fullyEquipped(): static
    {
        return $this->withHelmet()->withVest()->withTrousers()->withWeapon();
    }
}
