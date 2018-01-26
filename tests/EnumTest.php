<?php

namespace Saritasa\Tests;

use PHPUnit\Framework\TestCase;
use Saritasa\Enum;

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
        static::expectException(\UnexpectedValueException::class);
        new TestEnum('const3');
    }
}

class TestEnum extends Enum {
    const CONST1 = 'const1';
    const CONST2 = 'const2';
}