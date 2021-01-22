<?php

namespace Nbj;

use Closure;

/**
 * Class Number
 *
 * @method Number add($number, $precision = null) Adds a number to the number instance
 * @method Number subtract($number, $precision = null) Subtracts a number from the number instance
 * @method Number multiplyBy($number, $precision = null) Multiplies the number instance by a number
 * @method Number divideBy($number, $precision = null) Divides the number instance by a number
 * @method Number modulus($number, $precision = null) Modulus the number instance by a number
 * @method Number powerOf($number, $precision = null) Raise the number instance to the power of a number
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
     * The number of meaningful digits after the decimal point
     * The default value is set to 100
     *
     * @var int $decimalPrecision
     */
    protected $decimalPrecision = 100;

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
        'modulus'    => MathOperations\Modulus::class,
        'powerOf'    => MathOperations\Exponentiation::class,
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
        // Bail out if we are trying to construct a number
        // from anything non-numeric
        if ( ! is_numeric($numberValue)) {
            throw new Exceptions\NotAValidNumberException;
        }

        // As bcmath operates with strings only, we cast our
        // value to a string from the get-go
        $this->value = (string) $numberValue;
    }

    /**
     * Floors the value of the number
     *
     * @return static
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
     * @return static
     *
     * @throws Exceptions\NotAValidNumberException
     */
    public function ceil()
    {
        return static::create(ceil($this->value));
    }

    /**
     * Square roots the number
     *
     * @return static
     *
     * @throws Exceptions\NotAValidNumberException
     */
    public function squareRoot()
    {
        return static::create(bcsqrt($this->value, $this->decimalPrecision));
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
     * @param int $scale
     *
     * @return Number
     *
     * @throws Exceptions\ClosureMustReturnANumberInstanceException
     * @throws Exceptions\NotAValidNumberException
     */
    protected function performCalculation($operation, $number, $scale)
    {
        // We need to handle $number if it is an instance of Closure
        if ($number instanceof Closure) {
            $result = $number();

            if ( ! $result instanceof Number) {
                throw new Exceptions\ClosureMustReturnANumberInstanceException;
            }

            return $operation::calculate($this, $result, $scale);
        }

        // Otherwise if $number is not an instance of Number, we convert it
        if ( ! $number instanceof Number) {
            $number = static::create($number);
        }

        // Do the correct math and return a new Number instance
        return $operation::calculate($this, $number, $scale);
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

        // Resetting the arguments array also returns the first item to us
        // call this a hack as we do not want to depend on a collection package
        $number = reset($arguments);
        $precision = $this->decimalPrecision;

        // If we have more than 1 argument we need to deconstruct the arguments array
        if (count($arguments) > 1) {
            [$number, $precision] = $arguments;
        }

        return $this->performCalculation($this->mathOperations[$method], $number, $precision);
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
