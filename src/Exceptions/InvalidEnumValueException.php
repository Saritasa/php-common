<?php

namespace Saritasa\Exceptions;

use Throwable;

/**
 * Thrown, if the argument passed to the function does not match any of the possible values.
 */
class InvalidEnumValueException extends InvalidArgumentException
{
    /**
     * The valid enum constants.
     *
     * @var array $validConstants
     */
    protected $validConstants;

    /**
     * Thrown, if the argument passed to the function does not match any of the possible values.
     *
     * @param string $invalidConstant The invalid constant name.
     * @param array $validConstants The valid enum constants.
     * @param string|null $message The exception message.
     * @param int $code The exception code.
     * @param Throwable|null $previous The previously thrown exception.
     */
    public function __construct(
        string $invalidConstant,
        array $validConstants,
        string $message = null,
        int $code = 0,
        Throwable $previous = null)
    {
        $this->validConstants = $validConstants;
        $message = $message ?? "Constant \"$invalidConstant\" does not exist. Valid values are " .
            implode(', ', $validConstants);
        parent::__construct($message, $code, $previous);
    }

    /**
     * Returns the list of the valid enum constants.
     *
     * @return array
     */
    public function getValidConstants(): array
    {
        return $this->validConstants;
    }
}