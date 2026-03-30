<?php

namespace Tests\Unit\Enums;

use App\Enums\QuestOutcome;
use PHPUnit\Framework\TestCase;

class QuestOutcomeTest extends TestCase
{
    public function test_has_three_outcomes(): void
    {
        $this->assertCount(3, QuestOutcome::cases());
    }

    public function test_all_outcomes_have_string_values(): void
    {
        foreach (QuestOutcome::cases() as $outcome) {
            $this->assertIsString($outcome->value);
            $this->assertNotEmpty($outcome->value);
        }
    }

    public function test_can_create_from_valid_value(): void
    {
        $this->assertSame(QuestOutcome::Success, QuestOutcome::from('success'));
        $this->assertSame(QuestOutcome::Failure, QuestOutcome::from('failure'));
        $this->assertSame(QuestOutcome::Abandoned, QuestOutcome::from('abandoned'));
    }

    public function test_try_from_returns_null_for_invalid_value(): void
    {
        $this->assertNull(QuestOutcome::tryFrom('victory'));
    }

    public function test_contains_all_expected_outcomes(): void
    {
        $values = array_column(QuestOutcome::cases(), 'value');

        $this->assertContains('success', $values);
        $this->assertContains('failure', $values);
        $this->assertContains('abandoned', $values);
    }
}
