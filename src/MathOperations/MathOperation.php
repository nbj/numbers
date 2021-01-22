<?php

namespace Nbj\MathOperations;

use Nbj\Number;

abstract class MathOperation
{
    /**
     * Makes the calculation of the specific MathOperation
     *
     * @param Number $numberA
     * @param Number $numberB
     * @param int $scale
     *
     * @return Number
     */
    abstract public static function calculate(Number $numberA, Number $numberB, $scale = 0);
}
