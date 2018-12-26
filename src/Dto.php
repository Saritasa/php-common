<?php

namespace Saritasa;

use JsonSerializable;
use ReflectionClass;
use Saritasa\Exceptions\NotImplementedException;
use Saritasa\Traits\SimpleJsonSerialize;

/**
 * Parent class of data transfer object. Can be used to transfer data between application layers.
 * Inherit class and define protected properties to have read-only DTO.
 */
abstract class Dto implements JsonSerializable
{
    use SimpleJsonSerialize;

    protected static $propertiesCache;

    /**
     * Parent class of data transfer object. Can be used to transfer data between application layers.
     * Inherit class and define protected properties to have read-only DTO.
     *
     * @param mixed[] $data DTO properties values
     */
    public function __construct(array $data)
    {
        foreach (static::getInstanceProperties() as $key) {
            if (isset($data[$key])) {
                $this->$key = $data[$key];
            }
        }
    }

    /**
     * Returns array representation of DTO properties.
     *
     * @return mixed[]
     */
    public function toArray(): array
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
     *
     * @return mixed
     *
     * @throws NotImplementedException When requested property is not defined in DTO
     */
    public function __get($name)
    {
        if (in_array($name, static::getInstanceProperties())) {
            return $this->$name;
        } else {
            throw new NotImplementedException("Requesting unavailable field: $name");
        }
    }

    /**
     * Returns whether given property is set in DTO.
     *
     * @param string $name Property name to check
     *
     * @return boolean
     */
    public function __isset(string $name): bool
    {
        return in_array($name, static::getInstanceProperties()) && $this->$name !== null;
    }

    protected static function getInstanceProperties(): array
    {
        $class = static::class;
        if (!isset(static::$propertiesCache[$class])) {
            $cache = [];
            $reflect = new ReflectionClass($class);
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
