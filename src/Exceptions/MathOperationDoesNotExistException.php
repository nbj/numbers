<?php

namespace Nbj\Exceptions;

use Exception;
use Throwable;

class MathOperationDoesNotExistException extends Exception
{
    /**
     * NotAValidNumberException constructor.
     *
     * @param string $operation
     * @param Throwable|null $previous
     */
    public function __construct($operation, Throwable $previous = null)
    {
        $message = sprintf('The mathematical operation [%s] does not exist.', $operation);

        parent::__construct($message, 500, $previous);
    }
}
