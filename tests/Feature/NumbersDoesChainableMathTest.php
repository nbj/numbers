<?php

namespace Tests\Feature;

use Exception;
use Nbj\Number;
use PHPUnit\Framework\TestCase;
use Nbj\Exceptions\DivisionByZeroException;

class NumbersDoesChainableMathTest extends TestCase
{
    /** @test */
    public function a_number_does_addition()
    {
        // Arrange
        $number = Number::create(100);

        // Act
        $number->add(400);

        // Assert
        $this->assertEquals('500', $number);
    }

    /** @test */
    public function a_number_does_subtraction()
    {
        // Arrange
        $number = Number::create(100);

        // Act
        $number->subtract(50);

        // Assert
        $this->assertEquals('50', $number);
    }

    /** @test */
    public function a_number_does_multiplication()
    {
        // Arrange
        $number = Number::create(100);

        // Act
        $number->multiplyBy(5);

        // Assert
        $this->assertEquals('500', $number);
    }

    /** @test */
    public function a_number_does_division()
    {
        // Arrange
        $number = Number::create(100);

        // Act
        $number->divideBy(5);

        // Assert
        $this->assertEquals('20', $number);
    }

    /** @test */
    public function a_number_takes_exception_to_being_divided_by_zero()
    {
        // Arrange
        $number = Number::create(100);
        $sanityCheck = null;

        // Act
        try {
            $sanityCheck = $number->divideBy(0);
        } catch (Exception $exception) {
            $this->assertInstanceOf(DivisionByZeroException::class, $exception);
        }

        // Assert
        $this->assertNull($sanityCheck);
    }

    /** @test */
    public function a_number_has_chainable_mathematical_methods()
    {
        // Arrange
        $number = Number::create(1000);

        // Act
        $number
            ->add(4000)
            ->divideBy(1000)
            ->multiplyBy(5)
            ->subtract(20);

        // Assert
        $this->assertEquals(5, $number->asInteger());
    }
}
