<?php

namespace Nbj;

use Throwable;

class Number
{
    /**
     * Holds the value of the number, this is stored as a string because php floats are inherently imprecise
     *
     * @var string $value
     */
    public $value;

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
     */
    public function floor()
    {
        $this->value = (string) floor($this->value);

        return $this;
    }

    /**
     * Ceils the value of the number
     *
     * @return $this
     */
    public function ceil()
    {
        $this->value = (string) ceil($this->value);

        return $this;
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
     * Adds adds a number to this number
     *
     * @param mixed $number
     *
     * @return $this
     *
     * @throws Exceptions\NotAValidNumberException
     */
    public function add($number)
    {
        if ( ! $number instanceof Number) {
            $number = static::create($number);
        }

        $this->value = (string) bcadd($this, $number);

        return $this;
    }

    /**
     * Subtracts a number from this number
     *
     * @param mixed $number
     *
     * @return $this
     *
     * @throws Exceptions\NotAValidNumberException
     */
    public function subtract($number)
    {
        if ( ! $number instanceof Number) {
            $number = static::create($number);
        }

        $this->value = (string) bcsub($this, $number);

        return $this;
    }

    /**
     * Multiplies this number by another number
     *
     * @param mixed $number
     *
     * @return $this
     *
     * @throws Exceptions\NotAValidNumberException
     */
    public function multiplyBy($number)
    {
        if ( ! $number instanceof Number) {
            $number = static::create($number);
        }

        $this->value = (string) bcmul($this, $number);

        return $this;
    }

    /**
     * Divides this number by another number
     *
     * @param mixed $number
     *
     * @return $this
     *
     * @throws Exceptions\NotAValidNumberException
     * @throws Exceptions\DivisionByZeroException
     */
    public function divideBy($number)
    {
        if ( ! $number instanceof Number) {
            $number = static::create($number);
        }

        try {
            $result = bcdiv($this, $number);
        } catch (Throwable $throwable) {
            throw new Exceptions\DivisionByZeroException($throwable);
        }

        $this->value = (string) $result;

        return $this;
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
