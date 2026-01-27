<?php

namespace Database\Factories;

use App\Enums\DamageCard;
use App\Enums\ElementalType;
use App\Enums\WeaponClass;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Weapon>
 */
class WeaponFactory extends Factory
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
            'class' => fake()->randomElement(WeaponClass::cases()),
            'element' => fake()->randomElement(ElementalType::cases()),
            'damage' => [
                DamageCard::Zero->value => fake()->numberBetween(5, 8),
                DamageCard::One->value => fake()->numberBetween(5, 8),
                DamageCard::Two->value => fake()->numberBetween(5, 8),
                DamageCard::Three->value => fake()->numberBetween(5, 8),
                DamageCard::Four->value => fake()->numberBetween(5, 8),
            ],
        ];
    }
}
