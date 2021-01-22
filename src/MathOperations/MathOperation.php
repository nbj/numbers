<?php

namespace Nbj\MathOperations;

use Nbj\Number;

interface MathOperation
{
    /**
     * Makes the calculation of the specific MathOperation
     *
     * @param Number $numberA
     * @param Number $numberB
     *
     * @return mixed
     */
    public static function calculate(Number $numberA, Number $numberB);
}
