<?php

namespace Saritasa\Exceptions;

/**
 * Thrown, when user tries to perform operation, which he is not allowed to do
 */
class PermissionsException extends \Exception
{
    /**
     * HTTP Status Code. Default is 500 (Internal Server Error)
     *
     * @var int
     */
    protected $statusCode = 403;

    /**
     * Thrown, when user tries to perform operation, which he is not allowed to do
     *
     * @param string $message Message text, that can be reported to user
     * @param int $statusCode HTTP Status code
     */
    public function __construct($message = 'An error occurred', $statusCode = null)
    {
        parent::__construct($message);

        if (! is_null($statusCode)) {
            $this->setStatusCode($statusCode);
        }
    }

    /**
     * @param int $statusCode
     */
    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;
    }

    /**
     * @return int the status code
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }
}
