<?php

/**
 * @Package: some useful php string utility methods
 * @Class  : StrUtility
 * @Author : Nima jahan bakhshian / dvlpr1996 <nimajahanbakhshian@gmail.com>
 * @URL    : https://github.com/dvlpr1996
 * @License: MIT License Copyright (c) 2022 (until present) Nima jahan bakhshian
 */

declare(strict_types=1);

namespace PhpStringHelpers\utility;

use PhpStringHelpers\exceptions\UrlIsNotValidException;
use PhpStringHelpers\exceptions\FileDoesNotExistsException;
use PhpStringHelpers\exceptions\LanguageFileIsNotArrayException;

class StrUtility
{
    /**  @var string regex pattern for regular words pattern */
    const REGULAR_WORDS_PATTERN = '/[^a-zA-Z0-9]/i';

    private static function regularWords(string $words)
    {
        return trim(preg_replace(StrUtility::REGULAR_WORDS_PATTERN, ' ', $words));
    }

    /**
     * change words to camel case
     *
     * @param string $words
     * @return string
     */
    public static function toCamelCase(string $words): string
    {
        return str_replace(' ', '', lcfirst(ucwords(strtolower(self::regularWords($words)))));
    }

    /**
     * change words to pascal case
     *
     * @param string $words
     * @return string
     */
    public static function toPascalCase(string $words): string
    {
        return str_replace(' ', '', ucwords(strtolower(self::regularWords($words))));
    }

    /**
     * change words to kebab case
     *
     * @param string $words
     * @return string
     */
    public static function toKebabCase(string $words): string
    {
        return preg_replace('/\s+/', '-', strtolower(self::regularWords($words)));
    }

    /**
     * change words to title case
     *
     * @param string $words
     * @return string
     */
    public static function toTitleCase(string $words): string
    {
        return preg_replace('/\s+/', ' ', ucwords(strtolower(self::regularWords($words))));
    }

    /**
     * change words to constant case
     * like foo bar baz change to FOO_BAR_BAZ
     *
     * @param string $words
     * @return string
     */
    public static function toConstant(string $words): string
    {
        return preg_replace('/\s+/', '_', strtoupper(self::regularWords($words)));
    }

    /**
     * change words to snake case
     *
     * @param string $words
     * @return string
     */
    public static function toSnakeCase(string $words): string
    {
        return preg_replace('/\s+/', '_', strtolower(self::regularWords($words)));
    }

    /**
     * change words to path case like
     * foo bar baz change to foo/bar/baz
     *
     * @param string $words
     * @return string
     */
    public static function toPathCase(string $words): string
    {
        return preg_replace('/\s+/', '/', strtolower(self::regularWords($words)));
    }

    /**
     * change words to ada case
     * like foo bar change to Foo_Bar
     *
     * @param string $words
     * @return string
     */
    public static function toAdaCase(string $words): string
    {
        return preg_replace('/\s+/', '_', ucwords(strtolower(self::regularWords($words))));
    }

    /**
     * change words to dot notation case
     * like foo bar change to foo.bar
     *
     * @param string $words
     * @return string
     */
    public static function dotNotation(string $words): string
    {
        return preg_replace('/\s+/', '.', strtolower(self::regularWords($words)));
    }

    /**
     * wrapper for htmlspecialchars()
     *
     * @param $data
     * @return string
     */
    public static function entitiesWrapper($data): string
    {
        return htmlspecialchars($data ?? '', ENT_QUOTES, 'UTF-8');
    }

    /**
     * change string to slug
     *
     * @param string $string
     * @return string
     */
    public static function toSlug(string $string): string
    {
        $string = preg_replace('/[^\pL\d]+/i', '-', $string);
        return trim(strtolower(preg_replace('/-+/', '-', $string)), '-');
    }

    /**
     * remove all blanks
     *
     * @param string $string
     * @return string
     */
    public static function rmAllBlanks(string $string): string
    {
        return preg_replace('/[\s]/', '', $string);
    }

    /**
     * return alternate string if string param is null
     *
     * @param string|null $string
     * @param string|null $alternate
     * @return string
     * if alternate param is null return not defined strings
     */
    public static function alternate(?string $string, string $alternate = null): string
    {
        $returnString = $string ?: $alternate;
        return is_null($returnString) ? 'not defined' : self::clearString($returnString);
    }

    /**
     * translation methods
     * must create lang folder in root of project
     * lang/en
     *
     * @param string $key fileName.keyName |
     * translate('app.title') reference to lang/en/app.php and
     * title array key in app.php file
     * @param string $replace
     * [optional]
     * @param string $dirName
     * [optional] default directory name is en
     * @return string
     * @throws FileDoesNotExistsException
     * @throws LanguageFileIsNotArrayException
     */
    public static function translate(string $key, string $replace = '', string $dirName = 'en'): string
    {
        $fileName = explode('.', $key);
        $filePath = self::filePath('lang.' . $dirName . '.' . $fileName[0]);

        if (!is_file($filePath) || !file_exists($filePath))
            throw new FileDoesNotExistsException("File Does Not Exist");

        $data = require_once $filePath;

        if (!is_array($data))
            throw new LanguageFileIsNotArrayException("File data should be array");

        if (!key_exists($key, $data))
            return html_entity_decode(htmlentities($replace));

        return html_entity_decode(htmlentities($data[$key]));
    }

    /**
     * wrap given string with wrapper param
     *
     * @param int|string $string
     * @param string $wrapper
     * @return string
     */
    public static function wrapper(int|string $string, int|string $wrapper = '*'): string
    {
        $string = trim((string)$string);
        $wrapper = (string)$wrapper;

        $len = strlen($string) + strlen($wrapper) + strlen($wrapper);
        return str_pad($string, $len, $wrapper, STR_PAD_BOTH);
    }

    /**
     * return path of file from root of project
     *
     * @param string $path
     * path to the file like foo.bar.baz
     * @param string $pathExtension
     * [optional] declare file extension default is php file extension
     * @return string
     * @throws FileDoesNotExistsException
     */
    public static function filePath(string $path, string $pathExtension = 'php'): string
    {
        $path = getcwd() . '/' . str_replace(".", "/", implode(".", explode('.', $path)));
        $filePath = $path . '.' . strtolower($pathExtension);

        if (!is_file($filePath) || !file_exists($filePath))
            throw new FileDoesNotExistsException("File Does Not Exist");

        return $filePath;
    }

    /**
     * generate unique pin numbers
     * between 4 digit and 12 digit
     *
     * @param int $length
     * [optional] default is 4
     * @return int
     * if $length is bigger than 12 or less than 4 return 0
     * otherwise return generated pin
     */
    public static function generatePin(int $length = 4): int
    {
        if ($length < 4 || $length > 12) return 0;

        $min = str_pad('1', $length, '0');
        $max = str_pad('9', $length, '9');

        return mt_rand((int)$min, (int)$max);
    }

    /**
     * clean and safe given string data
     *
     * @param string $data
     * @return string
     */
    public static function clearString(string $data): string
    {
        $data = stripslashes(trim($data));
        $data = strip_tags($data);
        $data = self::rmExtraBlank($data);
        $data = html_entity_decode(htmlentities($data));
        $data = self::entitiesWrapper($data);
        return $data;
    }

    /**
     * return only string
     * [A-Za-z]
     *
     * @param string $data
     * @return string
     */
    public static function pureString(string $data): string
    {
        return self::rmExtraBlank(trim(preg_replace('/[^\pL]+/', ' ', $data)));
    }

    /**
     * generate random string
     *
     * @param int $size
     * [optional] default is 5
     * @return string
     */
    public static function randomChar(int $size = 5): string
    {
        $alphabet = str_shuffle('abcdefghijklmnopqrstuvwxyz');
        $words = '';

        for ($i = 0; $i < $size; $i++)
            $words .= $alphabet[mt_rand(0, strlen($alphabet) - 1)];

        return ucfirst($words);
    }

    /**
     * generate random hexadecimal color
     *
     * @return string
     */
    public static function randomHex(): string
    {
        return '#' . substr(dechex((int)mt_rand() * 16777215), 0, 6);
    }

    /**
     * generate random rgb color
     *
     * @return string
     */
    public static function randomRgb(): string
    {
        return mt_rand(0, 255) . '.' . mt_rand(0, 255) . '.' . mt_rand(0, 255);
    }

    /**
     * Remove all types of links
     *
     * @param string $string
     * @return string
     */
    public static function rmLink(string $string): string
    {
        $pattern = '[-a-zA-Z0-9+&@#\/%?=~_|$!:,.;]*[A-Za-z0-9+&@#\/%=~_|$.]/i';
        $protocols = 'https?|ftp|file|mailto|tel';

        $string = trim(preg_replace('/(' . $protocols . '):\/?\/?' . $pattern, '', $string));
        $string = preg_replace('/(www|localhost).' . $pattern, '', $string);
        $string = preg_replace('/(\d+\.){3}\d\/?' . $pattern, '', $string);
        $string = preg_replace('/(\d+\.){3}\d\/?/i', '', $string);
        $string = preg_replace('/(\w+\.).' . $pattern, '', $string);

        return self::rmExtraBlank($string);
    }

    /**
     * limit character based on $length and
     * replace theme with ...
     *
     * @param string|int $string
     * @param int $length
     * @return string
     * limitChar('foo bar',2) return foo b...
     */
    public static function limitChar(string|int $string, int $length): string
    {
        $string = (string)$string;

        if (strlen($string) <= $length)
            return $string;

        return self::rmRightChar($string, $length) . '...';
    }

    /**
     * generate unique id numbers
     *
     * @param string|int $prefix
     * [optional] default empty string
     * @param string|int $suffix
     * [optional] default empty string
     * @param bool $moreEntropy
     * [optional] default empty false
     * @return string
     */
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

    /**
     * remove all numbers
     *
     * @param string $string
     * @return string
     */
    public static function rmNumbers(string $string): string
    {
        $remove_hex = preg_replace('/(\b[xX]|0)[0-9a-fA-F]+/i', ' ', trim($string));
        $remove_decimal = preg_replace('/[\d]/im', ' ', trim($remove_hex));
        return self::rmExtraBlank($remove_decimal);
    }

    /**
     * remove all characters
     *
     * @param string $string
     * @return string
     */
    public static function rmCharacters(string $string): string
    {
        return self::rmExtraBlank(preg_replace('/[-_a-z\W]+/i', ' ', trim($string)));
    }

    /**
     * remove all extra blanks
     *
     * @param string $string
     * @return string
     */
    public static function rmExtraBlank(string $string): string
    {
        return preg_replace('/\s+/im', ' ', trim($string));
    }

    /**
     * convert hex color to rgb color
     *
     * @param string $color
     * @return string|null
     * return null if given hex color is not valid
     * otherwise return rgb color
     */
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

    /**
     * convert rgb color to hex color
     *
     * @param string $color
     * @return string|null
     * return null if given rgb color is not valid
     * otherwise return hex color
     */
    public static function rgbToHex(string $color): ?string
    {
        $rgb = explode('.', $color);

        foreach ($rgb as $value) {
            if (!preg_match("/^[0-9]+$/i", $value))
                return null;
        }

        return '#' . dechex((int)$rgb[0]) . dechex((int)$rgb[1]) . dechex((int)$rgb[2]);
    }

    /**
     * generate <a> tag link
     *
     * @param string|int $content
     * @param string $href
     * @return string
     * @throws UrlIsNotValidException
     */
    public static function generateAnchor(string|int $content, string $href): string
    {
        $href = filter_var(trim($href), FILTER_SANITIZE_URL);

        if (!filter_var($href, FILTER_VALIDATE_URL))
            throw new UrlIsNotValidException('Url Is Not Valid');

        return "<a href=$href>" . self::clearString($content) . '</a>';
    }

    /**
     * return encoding of string
     * wrapper for mb_detect_encoding()
     *
     * @param string $string
     * @return string
     */
    public static function getEncoding(string $string): string
    {
        return mb_detect_encoding($string, strict: true);
    }

    public static function isUtf8(string|array $string): bool
    {
        return mb_check_encoding($string, 'UTF-8');
    }

    /**
     * remove duplicate words
     *
     * @param string $string
     * @return string
     */
    public static function rmDuplicateWords(string $string): string
    {
        $string = array_unique(explode(' ', strtolower($string)));
        return self::rmExtraBlank(implode(' ', $string));
    }

    /**
     * remove characters from right side
     * based on $num param
     *
     * @param string $words
     * @param int $num
     * @return string
     */
    public static function rmRightChar(string $words, int $num): string
    {
        if (strlen($words) < $num)
            return $words;
        $characters = str_split(trim($words), 1);
        $characters = array_splice($characters, 0, -$num);
        return implode('', $characters);
    }

    /**
     * remove characters from left side
     * based on $num param
     *
     * @param string $words
     * @param int $num
     * @return string
     */
    public static function rmLeftChar(string $words, int $num): string
    {
        if (strlen($words) < $num)
            return $words;

        $characters = str_split(trim($words), 1);
        $characters = array_splice($characters, $num, count($characters));
        return implode('', $characters);
    }

    /**
     * remove characters from both side
     * based on $num param
     *
     * @param string $words
     * @param int $num
     * @return string
     */
    public static function rmBothSideChar(string $words, int $num): string
    {
        $words = self::rmLeftChar($words, $num);
        return self::rmRightChar($words, $num);
    }

    /**
     * find whether the type of a data is json
     *
     * @param mixed $data
     * @return bool
     * return false if $data is empty or string type or not a valid json
     * otherwise return true
     */
    public static function isJson(mixed $data): bool
    {
        if (empty($data) || !is_string($data))
            return false;

        if (!is_array(json_decode($data, true)) && json_last_error() !== JSON_ERROR_NONE)
            return false;

        return true;
    }

    /**
     * Checks whether the string contains the specified value or not
     *
     * @param string $string
     * @param string $search
     * @param bool $caseSensitive
     * [optional] default is false
     * @return bool
     */
    public static function isContains(string $string, string $search, bool $caseSensitive = false): bool
    {
        if (empty($search) || empty($string))
            return false;

        if ($caseSensitive)
            return false !== strpos($string, $search) || $search === '';

        return false !== stripos($string, $search) || $search === '';
    }

    /**
     * Checks whether the string starts with the specified value <$search> or not
     *
     * @param string $string
     * @param string $search
     * @param bool $caseSensitive
     * [optional] default false
     * @return bool
     */
    public static function isStartWith(string $string, string $search, bool $caseSensitive = false): bool
    {
        if (empty($search) || empty($string))
            return false;

        if ($caseSensitive)
            return strpos($string, $search) === 0;

        return false !== stripos($string, $search) || $search === '';
    }

    /**
     * return the last word
     *
     * @param string $string
     * @return string
     */
    public static function lastWord(string $string): string
    {
        if (empty($string))
            return '';

        if (strrpos(trim($string), ' ') === false)
            return $string;

        return substr($string, strrpos(trim($string), ' ') + 1);
    }

    /**
     * return the first word
     *
     * @param string $string
     * @return string
     */
    public static function firstWord(string $string): string
    {
        $firstWordStart = strpos(trim($string), ' ');

        if ($firstWordStart !== false)
            return substr($string, 0, $firstWordStart);

        return $string;
    }

    /**
     * return the first number
     *
     * @param string $string
     * @return string
     */
    public static function getFirstNumbers(string $string): string
    {
        if (preg_match_all('/^\d+/', $string, $numbers))
            return $numbers[0][0];

        return '';
    }

    /**
     * return the last number
     *
     * @param string $string
     * @return string
     */
    public static function getLastNumbers(string $string): string
    {
        if (preg_match_all('/\d+\b/', self::lastWord($string), $numbers))
            return end($numbers[0]);

        return '';
    }

    public static function rmBeginningNumbers(string $string): string
    {
        return self::rmExtraBlank(preg_replace('/\b\d+/i', '', trim($string)));
    }

    public static function rmEndingNumbers(string $string): string
    {
        return self::rmExtraBlank(preg_replace('/\d+\b/i', '', trim($string)));
    }

    public static function convertToUtf8(string $string): string|bool
    {
        $converter = iconv(mb_detect_encoding($string, mb_detect_order(), true), "UTF-8", $string);
        return $converter ? $converter : false;
    }

    /**
     * incrementing the numbers of the end of the string
     *
     * @param string $string
     * @param string|null $separator
     * [optional]
     * @return string
     * incrementBy('foo') return foo1
     */
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

    /**
     * decrementing the numbers of the end of the string
     *
     * @param string $string
     * @param string|null $separator
     * [optional]
     * @return string
     * decrementBy('foo2') return foo1
     */
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
