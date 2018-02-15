<?php

namespace Saritasa;

use ReflectionClass;
use Saritasa\Exceptions\InvalidEnumValueException;

/**
 * Enum implementation for PHP, alternative to \SplEnum.
 *
 * Uses reflection to get list of constants for a given enum subclass, but results are statically cached.
 *
 * @package App
 */
abstract class Enum implements \JsonSerializable
{
    private static $constCacheArray = null;

    private $value;

    /**
     * Enum implementation for PHP, alternative to \SplEnum.
     *
     * @param mixed $value String representation of enum value (must be valid enum value or exception will be thrown)
     * @throws InvalidEnumValueException
     */
    public function __construct($value)
    {
        if (!static::isValidValue($value)) {
            throw new InvalidEnumValueException('Value not a const in enum ' . get_class($this));
        }

        $this->value = $value;
    }

    /**
     * Returns scalar value of this enum.
     *
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Compares given enum value to another value
     *
     * @param Enum|mixed $value A scalar value or another Enum to compare with
     * @return boolean true if values are equal, false otherwise
     */
    public function equalsTo($value)
    {
        if (is_object($value) && $value instanceof Enum) {
            return $value->getValue() == $this->value;
        }
        return $value == $this->value;
    }

    /**
     * An array of all constants in this enum (keys are constant names).
     *
     * @return array
     */
    public static function getConstants() : array
    {
        if (self::$constCacheArray == null) {
            self::$constCacheArray = [];
        }
        $calledClass = get_called_class();
        if (!array_key_exists($calledClass, self::$constCacheArray)) {
            $reflect = new ReflectionClass($calledClass);
            self::$constCacheArray[$calledClass] = $reflect->getConstants();
        }
        return self::$constCacheArray[$calledClass];
    }

    /**
     * Checks if given value is valid for this enum class.
     *
     * @param mixed $value A value to check
     * @param bool $strict If strict comparison should be used or not
     * @return boolean True of value is valid, false otherwise
     */
    public static function isValidValue($value, $strict = true) : bool
    {
        $values = array_values(self::getConstants());
        return in_array($value, $values, $strict);
    }

    /**
     * Returns validated value for this enum class or throws exception if not.
     *
     * @param mixed $value value to be checked
     * @param bool $strict If strict comparison should be used or not
     * @return mixed validated value
     * @throws InvalidEnumValueException
     */
    public static function validate($value, $strict = true)
    {
        if (static::isValidValue($value, $strict) === false) {
            throw new InvalidEnumValueException(static::getConstants());
        }
        return $value;
    }

    /**
     * Converts value to a string
     *
     * @return string
     */
    public function __toString()
    {
        return (string)$this->value;
    }

    public function jsonSerialize()
    {
        return $this->__toString();
    }
}
