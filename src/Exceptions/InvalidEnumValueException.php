<?php

namespace Saritasa\Exceptions;

use Throwable;

/**
 * Thrown, if the argument passed to the function does not match any of the possible values.
 */
class InvalidEnumValueException extends InvalidArgumentException
{
    /* @var array $possibleValues possible values */
    protected $possibleValues;

    /**
     * Thrown, if the argument passed to the function does not match any of the possible values.
     *
     * @param array $possibleValues possible values
     * @param string|null $message exception message
     * @param int $code http code
     * @param Throwable|null $previous previous thrown exception
     */
    public function __construct(array $possibleValues, string $message = null, int $code = 0, Throwable $previous = null)
    {
        $this->possibleValues = $possibleValues;
        $message = $message ?? 'Value must be from the list: ' . implode(', ', $possibleValues);
        parent::__construct($message, $code, $previous);
    }

    /**
     * Returns list of possible values.
     *
     * @return array
     */
    public function getPossibleValues(): array
    {
        return $this->possibleValues;
    }
}