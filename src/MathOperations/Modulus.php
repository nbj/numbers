<?php

namespace Nbj\MathOperations;

use Nbj\Number;
use Nbj\Exceptions\NotAValidNumberException;

class Modulus extends MathOperation
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
     * @throws NotAValidNumberException
     */
    public static function calculate(Number $numberA, Number $numberB, $scale = 0)
    {
        return Number::create(bcmod($numberA, $numberB, $scale));
    }
}
