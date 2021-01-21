<?php

namespace Tests\Unit;

use Nbj\Number;
use PHPUnit\Framework\TestCase;

class NumberTest extends TestCase
{
    /** @test */
    public function it_automatically_outputs_its_value_as_a_string_when_to_stringed()
    {
        // Arrange
        $number = new Number(100);

        // Assert
        $this->assertEquals('100', $number);
    }

    /** @test */
    public function it_can_convert_its_value_to_an_integer()
    {
        // Arrange
        $number = new Number(100);

        // Assert
        $this->assertEquals(100, $number->asInteger());
    }

    /** @test */
    public function it_can_convert_its_value_to_a_float()
    {
        // Arrange
        $number = new Number(100.1);

        // Assert
        $this->assertEquals(100.1, $number->asFloat());
    }

    /** @test */
    public function the_as_integer_method_will_floor_floats_per_default()
    {
        // Arrange
        $numberA = new Number(100.1);
        $numberB = new Number(100.9);

        // Assert
        $this->assertEquals(100, $numberA->asInteger());
        $this->assertEquals(100, $numberB->asInteger());
    }

    /** @test */
    public function it_can_explicitly_floor_floats()
    {
        // Arrange
        $numberA = new Number(100);
        $numberB = new Number(100.5);

        // Assert
        $this->assertEquals('100', $numberA->floor());
        $this->assertEquals('100', $numberB->floor());
    }

    /** @test */
    public function it_can_explicitly_ceil_floats()
    {
        // Arrange
        $numberA = new Number(100);
        $numberB = new Number(100.5);

        // Assert
        $this->assertEquals('100', $numberA->ceil());
        $this->assertEquals('101', $numberB->ceil());
    }
}
