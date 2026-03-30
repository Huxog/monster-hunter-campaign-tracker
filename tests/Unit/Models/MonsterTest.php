<?php

namespace Tests\Unit\Models;

use App\Models\Monster;
use PHPUnit\Framework\TestCase;

class MonsterTest extends TestCase
{
    public function test_fillable_contains_expected_attributes(): void
    {
        $monster = new Monster;
        $expected = [
            'name',
            'description',
            'stars',
            'elementalWeaknesses',
            'ailmentWeaknesses',
            'imagePath',
        ];

        $this->assertEquals($expected, $monster->getFillable());
    }

    public function test_casts_stars_to_integer(): void
    {
        $monster = new Monster;
        $casts = $monster->getCasts();

        $this->assertArrayHasKey('stars', $casts);
        $this->assertEquals('integer', $casts['stars']);
    }

    public function test_casts_elemental_weaknesses_to_array(): void
    {
        $monster = new Monster;
        $casts = $monster->getCasts();

        $this->assertArrayHasKey('elementalWeaknesses', $casts);
        $this->assertEquals('array', $casts['elementalWeaknesses']);
    }

    public function test_casts_ailment_weaknesses_to_array(): void
    {
        $monster = new Monster;
        $casts = $monster->getCasts();

        $this->assertArrayHasKey('ailmentWeaknesses', $casts);
        $this->assertEquals('array', $casts['ailmentWeaknesses']);
    }

    public function test_uses_monsters_table(): void
    {
        $monster = new Monster;
        $this->assertEquals('monsters', $monster->getTable());
    }

    public function test_uses_soft_deletes(): void
    {
        $monster = new Monster;
        $this->assertTrue(method_exists($monster, 'trashed'));
    }

    public function test_uses_uuids(): void
    {
        $monster = new Monster;
        $this->assertFalse($monster->getIncrementing());
        $this->assertEquals('string', $monster->getKeyType());
    }
}
