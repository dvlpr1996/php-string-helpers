<?php
declare(strict_types=1);

namespace PhpStringHelpers\utility;

use src\exceptions\UrlIsNotValidException;
use src\exceptions\FileDoesNotExistsException;

class StrUtility
{
	const REGULAR_WORDS_PATTERN = '/[^a-z0-9]/im';

	private static function regularWords(string $words)
	{
		return trim(preg_replace(StrUtility::REGULAR_WORDS_PATTERN, ' ', $words));
	}

	public static function toCamelCase(string $words): string
	{
		return str_replace(' ', '', lcfirst(ucwords(self::regularWords($words))));
	}

	public static function toPascalCase(string $words): string
	{
		return str_replace(' ', '', ucwords(self::regularWords($words)));
	}

	public static function toKebabCase(string $words): string
	{
		return preg_replace('/\s+/', '-', strtolower(self::regularWords($words)));
	}

	public static function toTitleCase(string $words): string
	{
		return preg_replace('/\s+/', ' ', ucwords(self::regularWords($words)));
	}

	public static function toConstant(string $words): string
	{
		return preg_replace('/\s+/', '_', strtoupper(self::regularWords($words)));
	}

	public static function toSnakeCase(string $words): string
	{
		return preg_replace('/\s+/', '_', strtolower(self::regularWords($words)));
	}

	public static function toPathCase(string $words): string
	{
		return preg_replace('/\s+/', '/', strtolower(self::regularWords($words)));
	}

	public static function toAdaCase(string $words): string
	{
		return preg_replace('/\s+/', '_', ucwords(self::regularWords($words)));
	}

	public static function dotNotation(string $words): string
	{
		return preg_replace('/\s+/', '.', ucwords(self::regularWords($words)));
	}

	public static	function entitiesWrapper(string | int $data): string
	{
		return htmlspecialchars($data ?? '', ENT_QUOTES, 'UTF-8');
	}

	public static function toSlug(string $string): string
	{
		$string =  preg_replace('/[^\pL\d]+/i', '-', $string);
		return 	trim(strtolower(preg_replace('/-+/', '-', $string)), '-');
	}

	public static function rmAllBlank(string $words): string
	{
		return preg_replace('/[\s]/', '', $words);
	}

	public static function alternate(?string $string, string $alternate = null): string
	{
		$returnString = $string ?: $alternate;
		return is_null($returnString) ? 'not defined' : self::clearString($returnString);
	}

	public static function translate(string $key, string $replace = '', string $fileName = 'en'): string
	{
		$filePath = self::path('lang.' . $fileName);

		if (!is_file($filePath) || !file_exists($filePath))
			throw new FileDoesNotExistsException("File Does Not Exist");

		$data = require_once $filePath;

		if (!is_array($data))
			$data = [];

		if (!key_exists($key, $data))
			return html_entity_decode(htmlentities($replace));

		return html_entity_decode(htmlentities($data[$key]));
	}

	public static function wrapper(int|string $string, int|string $wrapper = '*'): string
	{
		$string = trim((string)$string);
		$wrapper = (string)$wrapper;

		$len = strlen($string) + strlen($wrapper) + strlen($wrapper);
		return str_pad($string, $len, $wrapper, STR_PAD_BOTH);
	}

	public static function path(string $path, string $pathExtension = 'php'): string
	{
		$path = getcwd() . '/../' . str_replace(".", "/", implode(".", explode('.', $path)));
		$filePath = $path . '.' . strtolower($pathExtension);

		if (!is_file($filePath) || !file_exists($filePath))
			throw new FileDoesNotExistsException("File Does Not Exist");

		return $filePath;
	}

	public static function generatePin(int $length = 4): int
	{
		if ($length < 4 || $length > 12) return 0;

		$min = str_pad('1', $length, '0');
		$max = str_pad('9', $length, '9');

		return mt_rand((int)$min, (int)$max);
	}

	public static function clearString(string $data): string
	{
		$data = stripslashes(trim($data));
		$data = strip_tags($data);
		$data = self::rmExtraBlank($data);
		$data = html_entity_decode(htmlentities($data));
		$data = self::entitiesWrapper($data);
		return $data;
	}

	public static function pureString(string $data): string
	{
		return trim(preg_replace('/[^\pL\d]+/', ' ', $data));
	}

	public static function randomWords(int $size = 5): string
	{
		$alphabet = str_shuffle('abcdefghijklmnopqrstuvwxyz');
		$words = '';

		for ($i = 0; $i < $size; $i++)
			$words .= $alphabet[mt_rand(0, strlen($alphabet) - 1)];

		return ucfirst($words);
	}

	public static function randomHex(): string
	{
		return '#' . substr(dechex((int)mt_rand() * 16777215), 0, 6);
	}

	public static function randomRgb(): string
	{
		return mt_rand(0, 255) . '.' . mt_rand(0, 255) . '.' . mt_rand(0, 255);
	}

	public static function rmLink(string $string): string
	{
		$pattern = '[-A-Z0-9+&@#\/%?=~_|$!:,.;]*[A-Z0-9+&@#\/%=~_|$.]/i';
		$string = trim(preg_replace('/(https?|ftp|file|mailto|tel):\/?\/?' . $pattern, '', $string));
		return preg_replace('/(www|localhost).' . $pattern, '', $string);
	}

	public static function limitChar(string|int $string, int $length): string
	{
		$string = (string)$string;
		return mb_strimwidth(trim($string), 0, $length + 3, '...');
	}

	public static function generateId(
		string|int $prefix = '',
		string|int $suffix = '',
		bool $moreEntropy = false
	): string {
		$suffix = empty($suffix) ? $suffix : '-' . $suffix;
		$prefix = empty($prefix) ? $prefix : $prefix . '-';
		$id = md5(uniqid(trim($prefix), $moreEntropy));
		return $prefix . $id . trim($suffix);
	}

	public static function rmNumbers(string $string): string
	{
		$remove_hex = preg_replace('/(\b[xX]|0)[0-9a-fA-F]+/i', ' ', trim($string));
		$remove_decimal = preg_replace('/[\d]/im', ' ', trim($remove_hex));
		return self::rmExtraBlank($remove_decimal);
	}

	public static function rmCharacters(string $string): string
	{
		return self::rmExtraBlank(preg_replace('/[-_a-z\W]+/i', ' ', trim($string)));
	}

	public static function rmExtraBlank(string $string): string
	{
		return preg_replace('/\s+/im', ' ', trim($string));
	}

	public static function hexToRgb(string $color): ?string
	{
		$hex = trim($color, '#');

		if (strlen($hex) !== 6)
			return null;

		if (!preg_match("/^[0-9ABCDEFabcdef\#]+$/i", $hex))
			return null;

		$r = substr($hex, 0, 2);
		$g = substr($hex, 2, 2);
		$b = substr($hex, 4, 2);

		return hexdec($r) . '.' . hexdec($g) . '.' . hexdec($b);
	}

	public static function rgbToHex(string $color): ?string
	{
		$rgb = explode('.', $color);

		foreach ($rgb as $value) {
			if (!preg_match("/^[0-9]+$/i", $value))
				return null;
		}

		return '#' . dechex((int)$rgb[0]) . dechex((int)$rgb[1]) . dechex((int)$rgb[2]);
	}

	public static function generateAnchor(string|int $content, string $href): string
	{
		$href = filter_var(trim($href), FILTER_SANITIZE_URL);

		if (!filter_var($href, FILTER_VALIDATE_URL))
			throw new UrlIsNotValidException('Url Is Not Valid');

		return "<a href=$href>" . self::clearString($content) . '</a>';
	}

	public static function getEncoding(string $string): string
	{
		return mb_detect_encoding($string, strict: true);
	}

	public static function isUtf8(string|array $string): bool
	{
		return mb_check_encoding($string, 'UTF-8');
	}

	public static function rmDuplicateWords(string $string): string
	{
		$string = preg_replace('/[\W]/i', ' ', strtolower($string));
		$string = array_unique(explode(' ', $string));
		return self::rmExtraBlank(implode(' ', $string));
	}

	public static function rmRightChar(string $words, int $num): string
	{
		$characters = str_split(trim($words), 1);
		$characters = array_splice($characters, 0, -$num);
		return implode('', $characters);
	}

	public static function rmLeftChar(string $words, int $num): string
	{
		$characters = str_split(trim($words), 1);
		$characters = array_splice($characters, $num, count($characters));
		return implode('', $characters);
	}

	public static function rmChar(string $words, int $num): string
	{
		$words = self::rmLeftChar($words, $num);
		return self::rmRightChar($words, $num);
	}

	public static function isJson(mixed $data): bool
	{
		if (empty($data) || !is_string($data))
			return false;

		if (!is_array(json_decode($data, true)) && json_last_error() !== JSON_ERROR_NONE)
			return false;

		return true;
	}

	public static function isContains(string $string, string $search, bool $caseSensitive = false): bool
	{
		if (empty($search) || empty($string))
			return false;

		if ($caseSensitive)
			return false !== strpos($string, $search) || $search === '';

		return false !== stripos($string, $search) || $search === '';
	}

	public static function isStartWith(string $string, string $search, bool $caseSensitive = false): bool
	{
		if (empty($search) || empty($string))
			return false;

		if ($caseSensitive)
			return strpos($string, $search) === 0;

		return false !== stripos($string, $search) || $search === '';
	}

	public static function lastWord(string $string): string
	{
		$string = trim($string);
		$lastWordStart = strrpos($string, ' ') + 1;
		return substr($string, $lastWordStart);
	}

	public static function firstWord(string $string): string
	{
		$string = trim($string);
		$firstWordStart = strpos($string, ' ');

		if ($firstWordStart !== false)
			return substr($string, 0, $firstWordStart);

		return $string;
	}

	public static function getFirstNumbers(string $string): string
	{
		if (preg_match_all('/^\d+/', $string, $numbers))
			return $numbers[0][0];

		return '';
	}

	public static function getLastNumbers(string $string): string
	{
		if (preg_match_all('/\d+\b/', self::lastWord($string), $numbers))
			return end($numbers[0]);

		return '';
	}

	public static function rmBeginningNumbers(string $string): string
	{
		return self::rmExtraBlank(preg_replace('/\b\d+/i', ' ', strtolower($string)));
	}

	public static function rmFinalNumbers(string $string): string
	{
		return self::rmExtraBlank(preg_replace('/\d+\b/i', ' ', strtolower($string)));
	}

	public static function convertToUtf8(string $string): string
	{
		return iconv(mb_detect_encoding($string, mb_detect_order(), true), "UTF-8", $string);
	}

	public static function incrementBy(string $string, ?string $separator = null): string
	{
		$separator = $separator ?: null;
		$numberPart = self::getLastNumbers($string);
		$stringPart = rtrim($string, $numberPart);

		if ($numberPart === '')
			return $string;

		$numberPart += 1;

		return $stringPart . $separator . (string)$numberPart;
	}

	public static function decrementBy(string $string, ?string $separator = null): string
	{
		$separator = $separator ?: null;
		$numberPart = self::getLastNumbers($string);
		$stringPart = rtrim($string, $numberPart);

		if ($numberPart === '')
			$numberPart = 0;

		$numberPart -= 1;

		return $stringPart . $separator . (string)$numberPart;
	}
}
