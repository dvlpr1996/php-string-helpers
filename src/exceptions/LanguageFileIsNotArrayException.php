<?php

namespace PhpStringHelpers\exceptions;

use Exception;

class LanguageFileIsNotArrayException extends Exception
{
    public function __construct(string $message, int $statusCode = 500)
    {
        parent::__construct($message, $statusCode);
    }
}
