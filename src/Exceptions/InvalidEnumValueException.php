<?php

namespace Saritasa\Exceptions;

use Saritasa\Enum;
use Throwable;

/**
 * Thrown, if the argument passed to the function does not match any of the possible values.
 */
class InvalidEnumValueException extends InvalidArgumentException
{
    /* @var array $allowedValues possible values */
    protected $allowedValues;

    /**
     * Thrown, if the argument passed to the function does not match any of the possible values.
     *
     * @param Enum|string|array $enum enumeration of possible values
     * @param string|null $message exception message
     * @param int $code http code
     * @param Throwable|null $previous previous thrown exception
     */
    public function __construct($enum, string $message = null, int $code = 0, Throwable $previous = null)
    {
        if (is_array($enum)) {
            $this->allowedValues = $enum;
        } elseif (is_a($enum, Enum::class, true)) {
            $this->allowedValues = $enum::getConstants();
        } else {
            $this->allowedValues = ["[not supported]"];
        }
        $message = $message ?? 'Value must be one of: ' . implode(', ', $this->allowedValues);
        parent::__construct($message, $code, $previous);
    }

    /**
     * Returns list of possible values.
     *
     * @return array
     */
    public function getAllowedValues(): array
    {
        return $this->allowedValues;
    }
}
