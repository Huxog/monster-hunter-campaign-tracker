<?php

namespace Database\Factories;

use App\Enums\AilmentType;
use App\Enums\ElementalType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Monster>
 */
class MonsterFactory extends Factory
{
    public function definition(): array
    {
        $elementalWeaknesses = collect(ElementalType::cases())
            ->filter(fn ($type) => $type !== ElementalType::None)
            ->mapWithKeys(fn ($type) => [$type->value => fake()->numberBetween(0, 3)])
            ->all();

        $ailmentWeaknesses = collect(AilmentType::cases())
            ->mapWithKeys(fn ($type) => [$type->value => fake()->numberBetween(0, 3)])
            ->all();

        return [
            'name' => fake()->word(),
            'description' => fake()->sentence(),
            'stars' => fake()->numberBetween(1, 7),
            'elementalWeaknesses' => $elementalWeaknesses,
            'ailmentWeaknesses' => $ailmentWeaknesses,
            'imagePath' => null,
        ];
    }
}
