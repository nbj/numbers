<?php

namespace Tests\Feature;

use Exception;
use Nbj\Number;
use PHPUnit\Framework\TestCase;
use Nbj\Exceptions\ClosureMustReturnANumberInstanceException;

class NumbersTakesCallablesInMathMethodsTest extends TestCase
{
    /** @test */
    public function the_add_method_can_take_a_callable_as_its_argument()
    {
        // Arrange
        $number = Number::create(100);
        $this->assertEquals('100', $number);

        // Act
        // This is equivalent to 100 + (25 * 4) - 50 = 150
        $number = $number
            ->add(function () {
                return Number::create(25)->multiplyBy(4);
            })
            ->subtract(50);

        // Assert
        $this->assertEquals('150', $number);
    }

    /** @test */
    public function the_subtract_method_can_take_a_callable_as_its_argument()
    {
        // Arrange
        $number = Number::create(100);
        $this->assertEquals('100', $number);

        // Act
        // This is equivalent to 100 + (20 * 5) - 30 = 10
        $number = $number
            ->subtract(function () {
                return Number::create(20)->multiplyBy(3);
            })
            ->subtract(30);

        // Assert
        $this->assertEquals('10', $number);
    }

    /** @test */
    public function the_multiply_by_method_can_take_a_callable_as_its_argument()
    {
        // Arrange
        $number = Number::create(100);
        $this->assertEquals('100', $number);

        // Act
        // This is equivalent to 100 * (100 * 25) + 100 = 500
        $number = $number
            ->multiplyBy(function () {
                return Number::create(100)->divideBy(25);
            })
            ->add(100);

        // Assert
        $this->assertEquals('500', $number);
    }

    /** @test */
    public function the_divide_by_method_can_take_a_callable_as_its_argument()
    {
        // Arrange
        $number = Number::create(100);
        $this->assertEquals('100', $number);

        // Act
        // This is equivalent to 100 / (4 * 25) + 199 = 200
        $number = $number
            ->divideBy(function () {
                return Number::create(4)->multiplyBy(25);
            })
            ->add(199);

        // Assert
        $this->assertEquals('200', $number);
    }

    /** @test */
    public function the_add_method_takes_exception_if_the_closure_passed_to_it_does_not_return_an_instance_of_number()
    {
        // Arrange
        $number = Number::create(100);
        $sanityCheck = null;

        // Act
        try {
            $sanityCheck = $number->add(function () {
                return 'this is not a number instance';
            });
        } catch (Exception $exception) {
            $this->assertInstanceOf(ClosureMustReturnANumberInstanceException::class, $exception);
        }

        // Assert
        $this->assertNull($sanityCheck);
    }

    /** @test */
    public function the_subtract_method_takes_exception_if_the_closure_passed_to_it_does_not_return_an_instance_of_number()
    {
        // Arrange
        $number = Number::create(100);
        $sanityCheck = null;

        // Act
        try {
            $sanityCheck = $number->subtract(function () {
                return 'this is not a number instance';
            });
        } catch (Exception $exception) {
            $this->assertInstanceOf(ClosureMustReturnANumberInstanceException::class, $exception);
        }

        // Assert
        $this->assertNull($sanityCheck);
    }

    /** @test */
    public function the_multiply_by_method_takes_exception_if_the_closure_passed_to_it_does_not_return_an_instance_of_number()
    {
        // Arrange
        $number = Number::create(100);
        $sanityCheck = null;

        // Act
        try {
            $sanityCheck = $number->multiplyBy(function () {
                return 'this is not a number instance';
            });
        } catch (Exception $exception) {
            $this->assertInstanceOf(ClosureMustReturnANumberInstanceException::class, $exception);
        }

        // Assert
        $this->assertNull($sanityCheck);
    }

    /** @test */
    public function the_divide_by_method_takes_exception_if_the_closure_passed_to_it_does_not_return_an_instance_of_number()
    {
        // Arrange
        $number = Number::create(100);
        $sanityCheck = null;

        // Act
        try {
            $sanityCheck = $number->divideBy(function () {
                return 'this is not a number instance';
            });
        } catch (Exception $exception) {
            $this->assertInstanceOf(ClosureMustReturnANumberInstanceException::class, $exception);
        }

        // Assert
        $this->assertNull($sanityCheck);
    }
}
