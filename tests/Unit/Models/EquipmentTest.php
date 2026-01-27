<?php

namespace Tests\Unit\Models;

use App\Enums\EquipmentType;
use App\Enums\WeaponClass;
use App\Models\Equipment;
use PHPUnit\Framework\TestCase;

class EquipmentTest extends TestCase
{
    public function test_fillable_contains_expected_attributes(): void
    {
        $equipment = new Equipment;
        $expected = [
            'name',
            'effect',
            'type',
            'armor',
            'elementalResistances',
            'class',
        ];

        $this->assertEquals($expected, $equipment->getFillable());
    }

    public function test_casts_type_to_equipment_type_enum(): void
    {
        $equipment = new Equipment;
        $casts = $equipment->getCasts();

        $this->assertArrayHasKey('type', $casts);
        $this->assertEquals(EquipmentType::class, $casts['type']);
    }

    public function test_casts_class_to_weapon_class_enum(): void
    {
        $equipment = new Equipment;
        $casts = $equipment->getCasts();

        $this->assertArrayHasKey('class', $casts);
        $this->assertEquals(WeaponClass::class, $casts['class']);
    }

    public function test_casts_elemental_resistances_to_array(): void
    {
        $equipment = new Equipment;
        $casts = $equipment->getCasts();

        $this->assertArrayHasKey('elementalResistances', $casts);
        $this->assertEquals('array', $casts['elementalResistances']);
    }

    public function test_uses_equipment_table(): void
    {
        $equipment = new Equipment;
        $this->assertEquals('equipment', $equipment->getTable());
    }
}
