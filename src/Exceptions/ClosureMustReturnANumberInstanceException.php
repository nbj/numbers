<?php

namespace Nbj\Exceptions;

use Exception;
use Throwable;

class ClosureMustReturnANumberInstanceException extends Exception
{
    /**
     * NotAValidNumberException constructor.
     *
     * @param Throwable|null $previous
     */
    public function __construct(Throwable $previous = null)
    {
        $message = 'Closure did not return an instance of Number.';

        parent::__construct($message, 500, $previous);
    }
}
