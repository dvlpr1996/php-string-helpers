<?php

namespace src\exceptions;

use Exception;

class FileDoesNotExistsException extends Exception
{
	public function __construct(string $message, int $statusCode = 500)
	{
		parent::__construct($message, $statusCode);
	}
}
