<?php

namespace PhpStringHelpers\exceptions;

use Exception;

class UrlIsNotValidException extends Exception
{
    public function __construct(string $message, int $statusCode = 500, $previous = null)
    {
        parent::__construct($message, $statusCode, $previous);
    }

    public function __toString()
    {
        return __CLASS__ . ' : ' . $this->message;
    }
}
