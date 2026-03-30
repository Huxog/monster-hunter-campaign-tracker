<?php

namespace Tests\Unit\Enums;

use App\Enums\AilmentType;
use PHPUnit\Framework\TestCase;

class AilmentTypeTest extends TestCase
{
    public function test_has_five_ailment_types(): void
    {
        $this->assertCount(5, AilmentType::cases());
    }

    public function test_all_ailment_types_have_string_values(): void
    {
        foreach (AilmentType::cases() as $ailment) {
            $this->assertIsString($ailment->value);
            $this->assertNotEmpty($ailment->value);
        }
    }

    public function test_can_create_from_valid_value(): void
    {
        $poison = AilmentType::from('Poison');
        $this->assertEquals(AilmentType::Poison, $poison);
    }

    public function test_try_from_returns_null_for_invalid_value(): void
    {
        $result = AilmentType::tryFrom('Bleed');
        $this->assertNull($result);
    }

    public function test_contains_all_expected_ailment_types(): void
    {
        $expected = ['Poison', 'Paralysis', 'Sleep', 'Stun', 'Blast'];
        $actual = array_map(fn ($case) => $case->value, AilmentType::cases());

        foreach ($expected as $ailment) {
            $this->assertContains($ailment, $actual, "Missing ailment: {$ailment}");
        }
    }
}
