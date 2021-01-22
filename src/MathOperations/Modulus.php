<?php

namespace Nbj\MathOperations;

use Nbj\Number;
use Nbj\Exceptions\NotAValidNumberException;

class Modulus implements MathOperation
{
    /**
     * Makes the calculation of the specific MathOperation
     *
     * @param Number $numberA
     * @param Number $numberB
     *
     * @return mixed
     *
     * @throws NotAValidNumberException
     */
    public static function calculate(Number $numberA, Number $numberB)
    {
        return Number::create(bcmod($numberA, $numberB));
    }
}
