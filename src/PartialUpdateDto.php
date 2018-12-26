<?php

namespace Saritasa;

class PartialUpdateDto extends Dto
{
    protected $updatedFields = [];

    public function __construct(array $data)
    {
        $this->updatedFields = array_intersect(array_keys($data), self::getInstanceProperties());
        parent::__construct($data);
    }

    public function getUpdatedFields()
    {
        return $this->updatedFields;
    }

    public function toArray(): array
    {
        $result = [];
        foreach ($this->updatedFields as $key) {
            $result[$key] = $this->$key;
        }
        return $result;
    }
}
