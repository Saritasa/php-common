<?php

namespace Saritasa\Tests;

use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;
use Saritasa\PartialUpdateDto;

class PartialUpdateDtoTest extends TestCase
{
    public function testExtractOnlyDeclaredFelds()
    {
        $data = new ExamplePartialDto(['field1' => 'data1', 'field2' => 'data2', 'field3' => 'data3']);
        $arr = $data->toArray();
        Assert::isTrue(is_array($arr));
        Assert::assertEquals('data1', $arr['field1']);
        Assert::assertEquals('data2', $arr['field2']);
        Assert::assertEquals(2, count(array_keys($arr)));
    }

    public function testRememberSourceFields()
    {
        $data = new ExamplePartialDto(['field2' => 'data2', 'field3' => 'data3']);

        Assert::assertNull($data->field1);

        $arr = $data->toArray();
        Assert::assertEquals(1, count(array_keys($arr)));
        Assert::assertEquals('data2', $arr['field2']);
    }

    public function testGetUpdatedFields()
    {
        $data = new ExamplePartialDto(['field2' => 'data2']);

        Assert::assertEquals(['field2'], $data->getUpdatedFields());
    }
}

class ExamplePartialDto extends PartialUpdateDto {
    protected $field1;
    protected $field2;
}
