<?php

namespace Saritasa\Tests;

use PHPUnit\Framework\TestCase;
use Saritasa\Enums\Gender;
use Saritasa\Exceptions\ArgumentNullException;
use Saritasa\Exceptions\InvalidEnumValueException;
use Saritasa\Exceptions\PermissionsException;

class ExceptionsTest extends TestCase
{
    public function testPermissionsException()
    {
        $ex = new PermissionsException("Access denied");
        static::assertEquals(403, $ex->getStatusCode());

        $ex = new PermissionsException("Generic problem", 400);
        static::assertEquals(400, $ex->getStatusCode());
    }

    public function testArgumentException()
    {
        $ex = new ArgumentNullException("parameterName");
        static::assertEquals('parameterName is required', $ex->getMessage());

        // You can get name of argument, which didn't pass validation
        static::assertEquals('parameterName', $ex->argumentName);
    }

    public function testInvalidEnumValueException()
    {
        $ex = new InvalidEnumValueException(['one', 'two']);
        static::assertEquals('Value must be one of: one, two', $ex->getMessage());

        $ex = new InvalidEnumValueException(Gender::class);
        static::assertEquals('Value must be one of: Male, Female', $ex->getMessage());

        $ex = new InvalidEnumValueException('bullshit');
        static::assertEquals('Value must be one of: [not supported]', $ex->getMessage());
    }
}
