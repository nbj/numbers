<?php

namespace Nbj\MathOperations;

use Throwable;
use Nbj\Number;
use Nbj\Exceptions;

class Division extends MathOperation
{
    /**
     * Makes the calculation of the specific MathOperation
     *
     * @param Number $numberA
     * @param Number $numberB
     * @param int $scale
     *
     * @return Number
     *
     * @throws Exceptions\DivisionByZeroException
     */
    public static function calculate(Number $numberA, Number $numberB, $scale = 0)
    {
        try {
            $result = Number::create(bcdiv($numberA, $numberB, $scale));
        } catch (Throwable $throwable) {
            throw new Exceptions\DivisionByZeroException($throwable);
        }

        return $result;
    }
}
