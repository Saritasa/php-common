<?php

namespace Saritasa;

/**
 * The base class for enums that associated with one string value.
 *
 * @package App
 */
class ValuedEnum
{
    /**
     * The numeric value associated with the enum value.
     *
     * @var int|float
     */
    protected $value = 0;

    /**
     * Constructor.
     *
     * @param int|float $value
     * @throw \InvalidArgumentException
     */
    protected function __construct($value)
    {
        if (!is_numeric($value)) {
            throw new \InvalidArgumentException('The enum value must be a numeric type.');
        }
        $this->value = $value;
    }

    /**
     * Returns the name that associated with the current enum value.
     *
     * @return int|float
     */
    public function getValue()
    {
        return $this->value;
    }
}