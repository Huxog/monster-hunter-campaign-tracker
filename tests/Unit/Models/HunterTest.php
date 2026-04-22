<?php

namespace Tests\Unit\Models;

use App\Models\Hunter;
use PHPUnit\Framework\TestCase;

class HunterTest extends TestCase
{
    public function test_fillable_contains_expected_attributes(): void
    {
        $hunter = new Hunter;
        $expected = [
            'playerName',
            'hunterName',
            'campaignId',
            'userId',
            'helmetId',
            'vestId',
            'trousersId',
            'weaponId',
            'class',
        ];

        $this->assertEquals($expected, $hunter->getFillable());
    }

    public function test_uses_hunters_table(): void
    {
        $hunter = new Hunter;
        $this->assertEquals('hunters', $hunter->getTable());
    }

    public function test_uses_soft_deletes(): void
    {
        $hunter = new Hunter;
        $this->assertTrue(method_exists($hunter, 'trashed'));
    }

    public function test_uses_uuids(): void
    {
        $hunter = new Hunter;
        $this->assertFalse($hunter->getIncrementing());
        $this->assertEquals('string', $hunter->getKeyType());
    }
}
