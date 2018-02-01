<?php

namespace Saritasa;

/**
 * Regular expression helper - save regular expression as a value
 * to improve semantics of your code
 */
class RegExp
{
    private $pattern;

    /**
     * Regular expression helper - save regular expression as a value
     * to improve semantics of your code
     *
     * @param string $pattern regular expression with delimiters, ex. "/test/i"
     */
    public function __construct($pattern)
    {
        $this->pattern = $pattern;
    }

    /**
     * Invoke as a function
     *
     * @param string $subject string to test against this regexp
     * @return false|integer
     */
    public function __invoke($subject)
    {
        return preg_match($this->pattern, $subject);
    }

    /**
     * Just for debugging convenience
     *
     * @return string
     */
    public function __toString()
    {
        return "Regular Expression (" . $this->pattern . ")";
    }
}
