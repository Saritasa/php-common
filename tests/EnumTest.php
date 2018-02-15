<?php

namespace Saritasa\Tests;

use PHPUnit\Framework\TestCase;
use Saritasa\Enum;
use Saritasa\Exceptions\InvalidEnumValueException;

class EnumTest extends TestCase
{
    public function testEnumValueParse()
    {
        static::assertTrue(TestEnum::isValidValue('const1'));
        static::assertFalse(TestEnum::isValidValue('const3'));
        $val1 = new TestEnum('const1');

        static::assertTrue($val1->equalsTo(TestEnum::CONST1));
        static::assertTrue($val1->equalsTo(new TestEnum('const1')));
        static::assertFalse($val1->equalsTo(TestEnum::CONST2));
        static::assertFalse($val1->equalsTo(new TestEnum('const2')));
    }

    public function testGetConstants()
    {
        $values = TestEnum::getConstants();
        static::assertEquals(2, count($values));
        static::assertContains('const1', $values);
        static::assertContains('const2', $values);
    }

    public function testInvalidValue()
    {
        static::expectException(InvalidEnumValueException::class);
        new TestEnum('const3');
    }

    public function testToString()
    {
        $val1 = new TestEnum('const1');
        static::assertEquals(TestEnum::CONST1, strval($val1));
    }

    public function testJsonSerialize()
    {
        $val1 = new TestEnum('const1');
        static::assertEquals(TestEnum::CONST1, strval($val1));
        static::assertEquals(TestEnum::CONST1, $val1->jsonSerialize());
    }

    public function testValidate()
    {
        TestEnum::validate('const1');

        static::expectException(InvalidEnumValueException::class);
        TestEnum::validate('bullshit');
    }
}

class TestEnum extends Enum {
    const CONST1 = 'const1';
    const CONST2 = 'const2';
}
