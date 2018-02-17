<?php

namespace Saritasa;

/**
 * The base class for enums that associated with one string value.
 *
 * @package App
 */
class NamedEnum
{
    /**
     * The name associated with the enum value.
     *
     * @var string
     */
    protected $name = '';

    /**
     * Constructor.
     *
     * @param string $name
     */
    protected function __construct(string $name)
    {
        $this->name = $name;
    }

    /**
     * Returns the name that associated with the current enum value.
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }
}