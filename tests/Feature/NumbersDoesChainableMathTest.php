<?php

namespace Tests\Feature;

use Exception;
use Nbj\Number;
use PHPUnit\Framework\TestCase;
use Nbj\Exceptions\DivisionByZeroException;
use Nbj\Exceptions\MathOperationDoesNotExistException;

class NumbersDoesChainableMathTest extends TestCase
{
    /** @test */
    public function a_number_does_addition()
    {
        // Arrange
        $number = Number::create(100);

        // Act
        $result = $number->add(400);

        // Assert
        $this->assertEquals('500', $result);
    }

    /** @test */
    public function a_number_does_subtraction()
    {
        // Arrange
        $number = Number::create(100);

        // Act
        $result = $number->subtract(50);

        // Assert
        $this->assertEquals('50', $result);
    }

    /** @test */
    public function a_number_does_multiplication()
    {
        // Arrange
        $number = Number::create(100);

        // Act
        $result = $number->multiplyBy(5);

        // Assert
        $this->assertEquals('500', $result);
    }

    /** @test */
    public function a_number_does_division()
    {
        // Arrange
        $number = Number::create(100);

        // Act
        $result = $number->divideBy(5);

        // Assert
        $this->assertEquals('20', $result);
    }

    /** @test */
    public function a_number_does_modulus()
    {
        // Arrange
        $number = Number::create(100);

        // Act
        $result = $number->modulus(80);

        // Assert
        $this->assertEquals('20', $result);
    }

    /** @test */
    public function a_number_does_exponentiation()
    {
        // Arrange
        $number = Number::create(10);

        // Act
        $result = $number->powerOf(5);

        // Assert
        $this->assertEquals('100000', $result);
    }

    /** @test */
    public function a_number_does_square_root()
    {
        // Arrange
        $number = Number::create(25);

        // Act
        $result = $number->squareRoot();

        // Assert
        $this->assertEquals('5', $result);
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
        $result = $number
            ->add(4000)
            ->divideBy(1000)
            ->multiplyBy(5)
            ->subtract(20);

        // Assert
        $this->assertEquals(5, $result->asInteger());
    }

    /** @test */
    public function a_number_takes_exception_to_mathematical_operations_that_does_not_exist()
    {
        // Arrange
        $number = Number::create(100);
        $sanityCheck = null;

        // Act
        try {
            $sanityCheck = $number->thisIsNotAPermittedOperation(0);
        } catch (Exception $exception) {
            $this->assertInstanceOf(MathOperationDoesNotExistException::class, $exception);
        }

        // Assert
        $this->assertNull($sanityCheck);
    }

    /** @test */
    public function check_that_bcmath_scale_is_not_fucking_shit_up()
    {
        // Arrange
        $number = Number::create(5);

        // Assert
        $this->assertEquals('2.5', $number->divideBy(2));
        $this->assertEquals('2', $number->divideBy(2, 0));
    }
}
