<?php

namespace Database\Factories;

use App\Enums\QuestOutcome;
use App\Models\Campaign;
use App\Models\Monster;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Quest>
 */
class QuestFactory extends Factory
{
    public function definition(): array
    {
        $completed = fake()->boolean(40);

        return [
            'campaignId' => Campaign::factory(),
            'monsterId' => Monster::factory(),
            'outcome' => $completed ? fake()->randomElement(QuestOutcome::cases())->value : null,
            'completedAt' => $completed ? fake()->dateTimeBetween('-1 month', 'now') : null,
        ];
    }

    public function inProgress(): static
    {
        return $this->state(['outcome' => null, 'completedAt' => null]);
    }

    public function completed(QuestOutcome $outcome = QuestOutcome::Success): static
    {
        return $this->state([
            'outcome' => $outcome->value,
            'completedAt' => fake()->dateTimeBetween('-1 month', 'now'),
        ]);
    }
}
