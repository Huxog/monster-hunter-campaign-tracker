<?php

namespace Tests\Unit\Enums;

use App\Enums\EquipmentType;
use PHPUnit\Framework\TestCase;

class EquipmentTypeTest extends TestCase
{
    public function test_has_three_equipment_types(): void
    {
        $this->assertCount(3, EquipmentType::cases());
    }

    public function test_contains_helmet_vest_and_trouser(): void
    {
        $types = array_map(fn ($case) => $case->value, EquipmentType::cases());

        $this->assertContains('helmet', $types);
        $this->assertContains('vest', $types);
        $this->assertContains('trouser', $types);
    }

    public function test_can_create_from_valid_value(): void
    {
        $helmet = EquipmentType::from('helmet');
        $this->assertEquals(EquipmentType::Helmet, $helmet);
    }

    public function test_try_from_returns_null_for_invalid_value(): void
    {
        $result = EquipmentType::tryFrom('gloves');
        $this->assertNull($result);
    }

    public function test_values_are_lowercase(): void
    {
        foreach (EquipmentType::cases() as $type) {
            $this->assertEquals(strtolower($type->value), $type->value);
        }
    }
}