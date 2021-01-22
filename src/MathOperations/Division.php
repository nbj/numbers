<?php

namespace Nbj\MathOperations;

use Throwable;
use Nbj\Number;
use Nbj\Exceptions;

class Division implements MathOperation
{
    /**
     * Makes the calculation of the specific MathOperation
     *
     * @param Number $numberA
     * @param Number $numberB
     *
     * @return mixed
     *
     * @throws Exceptions\NotAValidNumberException
     */
    public static function calculate(Number $numberA, Number $numberB)
    {
        try {
            $result = Number::create(bcdiv($numberA, $numberB));
        } catch (Throwable $throwable) {
            throw new Exceptions\DivisionByZeroException($throwable);
        }

        return $result;
    }
}
