<?php

namespace Saritasa;

class RegExp
{
    private $pattern;

    public function __construct($pattern)
    {
        $this->pattern = $pattern;
    }

    public function __invoke($subject)
    {
        return preg_match($this->pattern, $subject);
    }

    public function __toString()
    {
        return "Regular Expression (" . $this->pattern . ")";
    }
}