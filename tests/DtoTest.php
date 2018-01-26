<?php

namespace Saritasa\Tests;

use PHPUnit\Framework\TestCase;
use Saritasa\Dto;
use Saritasa\Exceptions\NotImplementedException;

class DtoTest extends TestCase
{
    public function testParseMatch()
    {
        $dto = new ExampleDto([
            'field1' => 'value1',
            'field2' => 2
        ]);
        $this->assertEquals('value1', $dto->field1);
        $this->assertEquals(2, $dto->field2);
    }

    public function testIgnoreUnknownFields()
    {
        $dto = new ExampleDto([
            'field1' => 'value1',
            'field2' => 2,
            'field3' => 'value3'
        ]);

        $array = $dto->toArray();

        $this->assertEquals(2, count($array));
        $this->assertEquals('value1', $array['field1']);
        $this->assertEquals(2, $array['field2']);
    }

    public function testIgnoreMissingFields()
    {
        $dto = new ExampleDto([
            'field1' => 'value1'
        ]);

        $array = $dto->toArray();

        $this->assertEquals(2, count($array));
        $this->assertEquals('value1', $array['field1']);
        $this->assertEquals(null, $array['field2']);
    }

    public function testToArray()
    {
        $dto = new ExampleDto([
            'field1' => 'value1',
            'field2' => 2
        ]);

        $array = $dto->toArray();

        $this->assertEquals(2, count($array));
        $this->assertEquals('value1', $array['field1']);
        $this->assertEquals(2, $array['field2']);
    }
    
    public function testToJson()
    {
        $dto = new ExampleDto([
            'field1' => 'value1',
            'field2' => 2
        ]);
        $this->assertEquals('{"field1":"value1","field2":2}', $dto->toJson());
    }

    public function testNonExistingProperty()
    {
        $dto = new ExampleDto([]);
        $this->assertEquals(null, $dto->field1);
        $this->assertEquals(null, $dto->field2);

        $this->expectException(NotImplementedException::class);
        $this->assertEquals(null, $dto->field3);
    }
}

/**
 * DOCStrings allows you to declare types and descriptions for dynamic read-only properties
 *
 * @property-read string $field1 This is a string field
 * @property-read int $field2 This is a numeric field
 */
class ExampleDto extends Dto {
    protected $field1;
    protected $field2;
}