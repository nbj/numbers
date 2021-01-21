<?php

namespace Nbj\Exceptions;

use Exception;
use Throwable;

class NotAValidNumberException extends Exception
{
    /**
     * NotAValidNumberException constructor.
     *
     * @param Throwable|null $previous
     */
    public function __construct(Throwable $previous = null)
    {
        $message = 'A Number instance could not be created from an invalid value passed to its constructor.';

        parent::__construct($message, 500, $previous);
    }
}
