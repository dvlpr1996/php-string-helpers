<?php

/**
 * @Package: some useful php string utility methods
 * @Class  : Facade
 * @Author : Nima jahan bakhshian / dvlpr1996 <nimajahanbakhshian@gmail.com>
 * @URL    : https://github.com/dvlpr1996
 * @License: MIT License Copyright (c) 2022 (until present) Nima jahan bakhshian
 */

declare(strict_types=1);

namespace dvlpr1996\PhpStringHelpers\Facade;

use RuntimeException;

class Facade
{
	protected static $getFacadeName;

	public static function __callStatic($name, $arguments)
	{
		$instance = new static::$getFacadeName;

		if (!$instance)
			throw new RuntimeException('A facade root has not been set.');

		return $instance->$name(...$arguments);
	}
}
