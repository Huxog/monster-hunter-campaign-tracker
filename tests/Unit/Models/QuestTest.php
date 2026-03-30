<?php

namespace Tests\Unit\Models;

use App\Enums\QuestOutcome;
use App\Models\Quest;
use PHPUnit\Framework\TestCase;

class QuestTest extends TestCase
{
    public function test_fillable_contains_expected_attributes(): void
    {
        $quest = new Quest;

        $this->assertEqualsCanonicalizing(
            ['campaignId', 'monsterId', 'outcome', 'completedAt'],
            $quest->getFillable()
        );
    }

    public function test_casts_outcome_to_quest_outcome_enum(): void
    {
        $quest = new Quest;

        $this->assertSame(QuestOutcome::class, $quest->getCasts()['outcome']);
    }

    public function test_casts_completed_at_to_datetime(): void
    {
        $quest = new Quest;

        $this->assertSame('datetime', $quest->getCasts()['completedAt']);
    }

    public function test_uses_quests_table(): void
    {
        $quest = new Quest;

        $this->assertSame('quests', $quest->getTable());
    }

    public function test_uses_soft_deletes(): void
    {
        $quest = new Quest;

        $this->assertTrue(method_exists($quest, 'trashed'));
    }

    public function test_uses_uuids(): void
    {
        $quest = new Quest;

        $this->assertFalse($quest->getIncrementing());
        $this->assertSame('string', $quest->getKeyType());
    }
}
