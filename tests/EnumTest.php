<?php

namespace Saritasa\Tests;

use PHPUnit\Framework\TestCase;
use Saritasa\Enum;
use Saritasa\Exceptions\InvalidEnumValueException;

class EnumTest extends TestCase
{
    public function testEnumConstructor()
    {
        static::assertFalse((new \ReflectionClass(TestEnum1::class))->isInstantiable());
        static::assertFalse((new \ReflectionClass(TestEnum2::class))->isInstantiable());
        static::assertFalse((new \ReflectionClass(TestEnum3::class))->isInstantiable());
    }

    public function testGetConstants()
    {
        static::assertEquals([
            'CONST1' => null,
            'CONST2' => null
        ], TestEnum1::getConstants());

        static::assertEquals([
            'CONST1' => null,
            'CONST2' => null
        ], TestEnum2::getConstants());

        static::assertEquals([
            'CONST1' => [1, 'a', 'Text #1'],
            'CONST2' => [2, 'b', 'Text #2'],
            'CONST3' => [3, 'c', 'Text #3']
        ], TestEnum3::getConstants());
    }

    public function testEnumValueParse()
    {
        static::assertInstanceOf(TestEnum1::class, TestEnum1::CONST1());
        static::assertInstanceOf(TestEnum1::class, TestEnum1::CONST2());
        static::assertInstanceOf(TestEnum2::class, TestEnum2::CONST2());
        static::assertInstanceOf(TestEnum3::class, TestEnum3::CONST3());
    }

    public function testEnumComparison()
    {
        static::assertEquals(TestEnum1::CONST1(), TestEnum1::CONST1());
        static::assertEquals(TestEnum3::CONST3(), TestEnum3::CONST3());
        static::assertEquals(TestEnum3::CONST1(), 'CONST1');

        static::assertNotEquals(TestEnum1::CONST1(), TestEnum2::CONST1());
        static::assertNotEquals(TestEnum1::CONST1(), TestEnum3::CONST1());
        static::assertNotEquals(TestEnum3::CONST1(), TestEnum2::CONST2());
    }

    public function testInvalidValue()
    {
        static::expectException(InvalidEnumValueException::class);
        TestEnum1::CONST3();
    }

    public function testMethodShortcuts()
    {
        static::assertEquals('CONST2', TestEnum1::CONST2('constantName'));
        static::assertEquals('CONST2', TestEnum2::CONST2('constantName'));

        static::assertEquals(2, TestEnum3::CONST2('id'));
        static::assertEquals('a', TestEnum3::CONST1('key'));
        static::assertEquals('Text #3', TestEnum3::CONST3('text'));
    }

    public function testInvalidMethodShortcut()
    {
        static::expectException(\BadMethodCallException::class);
        TestEnum1::CONST1('id');
    }

    public function testToString()
    {
        static::assertEquals('CONST1', (string)TestEnum1::CONST1());
        static::assertEquals('CONST2', (string)TestEnum2::CONST2());
        static::assertEquals('CONST3', (string)TestEnum3::CONST3());
    }
    public function testJsonSerialize()
    {
        static::assertEquals('"CONST1"', json_encode(TestEnum1::CONST1()));
        static::assertEquals('"CONST2"', json_encode(TestEnum2::CONST2()));
        static::assertEquals('"CONST3"', json_encode(TestEnum3::CONST3()));
    }
}

/**
 * @method static TestEnum1 CONST1(...$params)
 * @method static TestEnum1 CONST2(...$params)
 */
class TestEnum1 extends Enum {
    const CONST1 = null;
    const CONST2 = null;
}

/**
 * @method static TestEnum1 CONST1(...$params)
 * @method static TestEnum1 CONST2(...$params)
 */
class TestEnum2 extends Enum {
    const CONST1 = null;
    const CONST2 = null;
}

/**
 * @method static TestEnum1 CONST1(...$params)
 * @method static TestEnum1 CONST2(...$params)
 * @method static TestEnum1 CONST3(...$params)
 */
class TestEnum3 extends Enum {
    const CONST1 = [1, 'a', 'Text #1'];
    const CONST2 = [2, 'b', 'Text #2'];
    const CONST3 = [3, 'c', 'Text #3'];

    private $id = 0;
    private $key = '';
    private $text = '';

    protected function __construct(int $id, string $key, string $text)
    {
        $this->id = $id;
        $this->key = $key;
        $this->text = $text;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getKey()
    {
        return $this->key;
    }

    public function getText()
    {
        return $this->text;
    }
}