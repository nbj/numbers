<?php

namespace Tests\Feature;

use Exception;
use Nbj\Number;
use PHPUnit\Framework\TestCase;
use Nbj\Exceptions\NotAValidNumberException;

class NumbersCanBeCreatedAsInstancesTest extends TestCase
{
    /** @test */
    public function numbers_can_be_newed_up_from_integers()
    {
        // Act
        $number = new Number(1);

        // Assert
        $this->assertInstanceOf(Number::class, $number);
    }

    /** @test */
    public function numbers_can_be_newed_up_from_floats()
    {
        // Act
        $number = new Number(1.2);

        // Assert
        $this->assertInstanceOf(Number::class, $number);
    }

    /** @test */
    public function numbers_can_be_newed_up_from_a_string_containing_a_valid_number()
    {
        // Act
        $numberA = new Number('1');
        $numberB = new Number('1.2');

        // Assert
        $this->assertInstanceOf(Number::class, $numberA);
        $this->assertInstanceOf(Number::class, $numberB);
    }

    /** @test */
    public function it_takes_exception_to_being_newed_up_with_a_non_valid_value()
    {
        // Arrange
        $sanityCheck = null;

        // Act
        try {
            $sanityCheck = new Number('this is not a valid number');
        } catch (Exception $exception) {
            $this->assertInstanceOf(NotAValidNumberException::class, $exception);
        }

        // Assert
        $this->assertNull($sanityCheck);
    }

    /** @test */
    public function numbers_can_be_created_using_a_named_constructor()
    {
        // Act
        $numberA = Number::create(100);
        $numberB = Number::create(100.1);
        $numberC = Number::create('100.1');

        // Assert
        $this->assertInstanceOf(Number::class, $numberA);
        $this->assertInstanceOf(Number::class, $numberB);
        $this->assertInstanceOf(Number::class, $numberC);
    }
}
