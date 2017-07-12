<?php

namespace Saritasa\Exceptions;

use Throwable;

/** Thrown, if function expects parameter to have not null/not empty value */
class ArgumentNullException extends InvalidArgumentException
{
    public $argumentName;

    public function __construct(string $argumentName, string $message = "", int $code = 0, Throwable $previous = null)
    {
        $this->argumentName = $argumentName;
        if (!$message) {
            $message = $argumentName." is required";
        }
        parent::__construct($message, $code, $previous);
    }
}
