<?php

namespace Nbj\Exceptions;

use Exception;
use Throwable;

class DivisionByZeroException extends Exception
{
    /**
     * DivisionByZeroException constructor.
     *
     * @param Throwable|null $previous
     */
    public function __construct(Throwable $previous = null)
    {
        $message = 'A Number cannot be divided by zero.';

        parent::__construct($message, 500, $previous);
    }
}
