<?php

namespace Nbj;

use Closure;

/**
 * Class Number
 *
 * @method Number add($number) Adds a number to the number instance
 * @method Number subtract($number) Subtracts a number from the number instance
 * @method Number multiplyBy($number) Multiplies the number instance by a number
 * @method Number divideBy($number) Divides the number instance by a number
 */
class Number
{
    /**
     * Holds the value of the number, this is stored as a string because php floats are inherently imprecise
     *
     * @var string $value
     */
    protected $value;

    /**
     * Holds a list of all possible mathematical operations
     *
     * @var array $mathOperations
     */
    protected $mathOperations = [
        'add'        => MathOperations\Addition::class,
        'subtract'   => MathOperations\Subtraction::class,
        'multiplyBy' => MathOperations\Multiplication::class,
        'divideBy'   => MathOperations\Division::class,
    ];

    /**
     * Named constructor for creating a new instance of a number
     *
     * @param $numberValue
     *
     * @return static
     *
     * @throws Exceptions\NotAValidNumberException
     */
    public static function create($numberValue)
    {
        return new static($numberValue);
    }

    /**
     * Number constructor.
     *
     * @param mixed $numberValue
     *
     * @throws Exceptions\NotAValidNumberException
     */
    public function __construct($numberValue)
    {
        if ( ! is_numeric($numberValue)) {
            throw new Exceptions\NotAValidNumberException;
        }

        $this->value = (string) $numberValue;
    }

    /**
     * Floors the value of the number
     *
     * @return $this
     *
     * @throws Exceptions\NotAValidNumberException
     */
    public function floor()
    {
        return static::create(floor($this->value));
    }

    /**
     * Ceils the value of the number
     *
     * @return $this
     *
     * @throws Exceptions\NotAValidNumberException
     */
    public function ceil()
    {
        return static::create(ceil($this->value));
    }

    /**
     * Converts the value of the number to an integer
     *
     * Default operation will floor the number
     *
     * @return int
     */
    public function asInteger()
    {
        return (int) $this->value;
    }

    /**
     * Converts the value of the number to a float
     *
     * @return float
     */
    public function asFloat()
    {
        return (float) $this->value;
    }

    /**
     * Performs the calculation based on the operation passed to it
     *
     * @param string $operation
     * @param mixed $number
     *
     * @return Number
     *
     * @throws Exceptions\ClosureMustReturnANumberInstanceException
     * @throws Exceptions\NotAValidNumberException
     */
    protected function performCalculation($operation, $number)
    {
        // We need to handle $number if it is an instance of Closure
        if ($number instanceof Closure) {
            $result = $number();

            if ( ! $result instanceof Number) {
                throw new Exceptions\ClosureMustReturnANumberInstanceException;
            }

            return $operation::calculate($this, $result);
        }

        // Otherwise if $number is not an instance of Number, we convert it
        if ( ! $number instanceof Number) {
            $number = static::create($number);
        }

        // Do the correct math and return a new Number instance
        return $operation::calculate($this, $number);
    }

    /**
     * Delegates mathematical method calls to the right operations
     *
     * @param string $method
     * @param array $arguments
     *
     * @return Number
     *
     * @throws Exceptions\ClosureMustReturnANumberInstanceException
     * @throws Exceptions\MathOperationDoesNotExistException
     */
    public function __call($method, $arguments)
    {
        if ( ! array_key_exists($method, $this->mathOperations)) {
            throw new Exceptions\MathOperationDoesNotExistException($method);
        }

        return $this->performCalculation($this->mathOperations[$method], $arguments[0]);
    }

    /**
     * Gets the value of the number as a string
     *
     * @return string
     */
    public function __toString()
    {
        return $this->value;
    }
}
