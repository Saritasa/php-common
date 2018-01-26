<?php

namespace Saritasa\Tests;

use PHPUnit\Framework\TestCase;
use Saritasa\RegExp;

class RegExpTest extends TestCase
{
    public function testRegExpCaseSensitive()
    {
        $re = new RegExp("/test/");
        static::assertEquals(1, $re("My test string"));
        static::assertEquals(0, $re("My string"));

        static::assertEquals(0, $re("My Test String"), "Case should not match");
    }

    public function testRegExpCaseInsensitive()
    {
        $re = new RegExp("/test/i");
        static::assertEquals(1, $re("My test string"));
        static::assertEquals(0, $re("My string"));

        static::assertEquals(1, $re("My Test String"), "Case should be ignored");
    }
}