<?php

namespace Saritasa\Tests;

use PHPUnit\Framework\TestCase;
use Saritasa\Dto;

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

    public function testToArray()
    {
        $dto = new ExampleDto([
            'field1' => 'value1',
            'field2' => 2
        ]);

        $array = $dto->toArray();

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