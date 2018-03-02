<?php

namespace Saritasa;

use Saritasa\Exceptions\NotImplementedException;
use Saritasa\Traits\SimpleJsonSerialize;

/**
 * Inherit this class and define protected fields to get read-only DTO
 */
abstract class Dto implements \JsonSerializable
{
    use SimpleJsonSerialize;

    protected static $propertiesCache;

    public function __construct(array $data)
    {
        foreach (static::getInstanceProperties() as $key) {
            if (isset($data[$key])) {
                $this->$key = $data[$key];
            }
        }
    }

    public function toArray()
    {
        $result = [];
        foreach (static::getInstanceProperties() as $key) {
            $result[$key] = $this->$key;
        }
        return $result;
    }


    /**
     * All instance fields are available as read-only properties
     *
     * @param string $name Name of private field to return
     * @return mixed
     * @throws NotImplementedException
     */
    public function __get($name)
    {
        if (in_array($name, static::getInstanceProperties())) {
            return $this->$name;
        } else {
            throw new NotImplementedException("Requesting unavailable field: $name");
        }
    }

    protected static function getInstanceProperties(): array
    {
        $class = static::class;
        if (!isset(static::$propertiesCache[$class])) {
            $cache = [];
            $reflect = new \ReflectionClass($class);
            foreach ($reflect->getProperties() as $property) {
                if (!$property->isStatic()) {
                    $cache[] = $property->getName();
                }
            }
            static::$propertiesCache[$class] = $cache;
        }
        return static::$propertiesCache[$class];
    }
}
