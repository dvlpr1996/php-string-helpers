<?php
declare(strict_types=1);

use PhpStringHelpers\utility\StrUtility as strHelpers;

if (!function_exists('toCamelCase')) {
	function toCamelCase(string $words): string
	{
		return strHelpers::toCamelCase($words);
	}
}

if (!function_exists('toPascalCase')) {
	function toPascalCase(string $words): string
	{
		return strHelpers::toPascalCase($words);
	}
}

if (!function_exists('toKebabCase')) {
	function toKebabCase(string $words): string
	{
		return strHelpers::toKebabCase($words);
	}
}

if (!function_exists('toTitleCase')) {
	function toTitleCase(string $words): string
	{
		return strHelpers::toTitleCase($words);
	}
}

if (!function_exists('toConstant')) {
	function toConstant(string $words): string
	{
		return strHelpers::toConstant($words);
	}
}

if (!function_exists('toSnakeCase')) {
	function toSnakeCase(string $words): string
	{
		return strHelpers::toSnakeCase($words);
	}
}

if (!function_exists('toPathCase')) {
	function toPathCase(string $words): string
	{
		return strHelpers::toPathCase($words);
	}
}

if (!function_exists('toAdaCase')) {
	function toAdaCase(string $words): string
	{
		return strHelpers::toAdaCase($words);
	}
}

if (!function_exists('dotNotation')) {
	function dotNotation(string $words): string
	{
		return strHelpers::dotNotation($words);
	}
}

if (!function_exists('entitiesWrapper')) {
	function entitiesWrapper(string | int $data): string
	{
		return strHelpers::entitiesWrapper($data);
	}
}

if (!function_exists('toSlug')) {
	function toSlug(string $string): string
	{
		return strHelpers::toSlug($string);
	}
}

if (!function_exists('rmAllBlank')) {
	function rmAllBlank(string $words): string
	{
		return strHelpers::rmAllBlank($words);
	}
}

if (!function_exists('alternate')) {
	function alternate(?string $string, string $alternate = null): string
	{
		return strHelpers::alternate($string, $alternate);
	}
}

if (!function_exists('translate')) {
	function translate(string $key, string $replace = '', string $fileName = 'en'): string
	{
		return strHelpers::translate($key, $replace, $fileName);
	}
}

if (!function_exists('wrapper')) {
	function wrapper(int|string $string, int|string $wrapper = '*'): string
	{
		return strHelpers::wrapper($string, $wrapper);
	}
}

if (!function_exists('path')) {
	function path(string $path, string $pathExtension = 'php'): string
	{
		return strHelpers::path($path, $pathExtension);
	}
}

if (!function_exists('generatePin')) {
	function generatePin(int $length = 4): int
	{
		return strHelpers::generatePin($length);
	}
}

if (!function_exists('clearString')) {
	function clearString(string $data): string
	{
		return strHelpers::clearString($data);
	}
}

if (!function_exists('pureString')) {
	function pureString(string $data): string
	{
		return strHelpers::pureString($data);
	}
}

if (!function_exists('randomWords')) {
	function randomWords(int $size = 5): string
	{
		return strHelpers::randomWords($size);
	}
}

if (!function_exists('randomWords')) {
	function randomWords(int $size = 5): string
	{
		return strHelpers::randomWords($size);
	}
}

if (!function_exists('randomHex')) {
	function randomHex(): string
	{
		return strHelpers::randomHex();
	}
}

if (!function_exists('randomRgb')) {
	function randomRgb(): string
	{
		return strHelpers::randomRgb();
	}
}

if (!function_exists('rmLink')) {
	function rmLink(string $string): string
	{
		return strHelpers::rmLink($string);
	}
}

if (!function_exists('limitChar')) {
	function limitChar(string|int $string, int $length): string
	{
		return strHelpers::limitChar($string,  $length);
	}
}

if (!function_exists('generateId')) {
	function generateId(
		string|int $prefix = '',
		string|int $suffix = '',
		bool $moreEntropy = false
	): string {
		return strHelpers::generateId($prefix, $suffix, $moreEntropy);
	}
}

if (!function_exists('rmNumbers')) {
	function rmNumbers(string $string): string
	{
		return strHelpers::rmNumbers($string);
	}
}

if (!function_exists('rmCharacters')) {
	function rmCharacters(string $string): string
	{
		return strHelpers::rmCharacters($string);
	}
}

if (!function_exists('rmExtraBlank')) {
	function rmExtraBlank(string $string): string
	{
		return strHelpers::rmExtraBlank($string);
	}
}

if (!function_exists('hexToRgb')) {
	function hexToRgb(string $color): ?string
	{
		return strHelpers::hexToRgb($color);
	}
}

if (!function_exists('rgbToHex')) {
	function rgbToHex(string $color): ?string
	{
		return strHelpers::rgbToHex($color);
	}
}

if (!function_exists('generateAnchor')) {
	function generateAnchor(string|int $content, string $href): string
	{
		return strHelpers::generateAnchor($content, $href);
	}
}

if (!function_exists('getEncoding')) {
	function getEncoding(string $string): string
	{
		return strHelpers::getEncoding($string);
	}
}

if (!function_exists('isUtf8')) {
	function isUtf8(string|array $string): bool
	{
		return strHelpers::isUtf8($string);
	}
}

if (!function_exists('rmDuplicateWords')) {
	function rmDuplicateWords(string $string): string
	{
		return strHelpers::rmDuplicateWords($string);
	}
}

if (!function_exists('rmRightChar')) {
	function rmRightChar(string $words, int $num): string
	{
		return strHelpers::rmRightChar($words,  $num);
	}
}

if (!function_exists('rmLeftChar')) {
	function rmLeftChar(string $words, int $num): string
	{
		return strHelpers::rmLeftChar($words, $num);
	}
}

if (!function_exists('rmChar')) {
	function rmChar(string $words, int $num): string
	{
		return strHelpers::rmChar($words, $num);
	}
}

if (!function_exists('isJson')) {
	function isJson(mixed $data): bool
	{
		return strHelpers::isJson($data);
	}
}

if (!function_exists('isContains')) {
	function isContains(string $string, string $search, bool $caseSensitive = false): bool
	{
		return strHelpers::isContains($string, $search, $caseSensitive);
	}
}

if (!function_exists('isStartWith')) {
	function isStartWith(string $string, string $search, bool $caseSensitive = false): bool
	{
		return strHelpers::isStartWith($string, $search, $caseSensitive);
	}
}

if (!function_exists('lastWord')) {
	function lastWord(string $string): string
	{
		return strHelpers::lastWord($string);
	}
}

if (!function_exists('firstWord')) {
	function firstWord(string $string): string
	{
		return strHelpers::firstWord($string);
	}
}

if (!function_exists('getFirstNumbers')) {
	function getFirstNumbers(string $string): string
	{
		return strHelpers::getFirstNumbers($string);
	}
}

if (!function_exists('getLastNumbers')) {
	function getLastNumbers(string $string): string
	{
		return strHelpers::getLastNumbers($string);
	}
}

if (!function_exists('rmBeginningNumbers')) {
	function rmBeginningNumbers(string $string): string
	{
		return strHelpers::rmBeginningNumbers($string);
	}
}

if (!function_exists('rmFinalNumbers')) {
	function rmFinalNumbers(string $string): string
	{
		return strHelpers::rmFinalNumbers($string);
	}
}

if (!function_exists('convertToUtf8')) {
	function convertToUtf8(string $string): string
	{
		return strHelpers::convertToUtf8($string);
	}
}

if (!function_exists('incrementBy')) {
	function incrementBy(string $string, ?string $separator = null): string
	{
		return strHelpers::incrementBy($string, $separator);
	}
}

if (!function_exists('decrementBy')) {
	function decrementBy(string $string, ?string $separator = null): string
	{
		return strHelpers::decrementBy($string, $separator);
	}
}
