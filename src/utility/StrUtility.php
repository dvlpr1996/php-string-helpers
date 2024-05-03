<?php

/**
 * @Package: Some Useful Php String Utility Methods
 * @Class  : StrUtility
 * @Author : Nima jahan bakhshian / dvlpr1996 <nimajahanbakhshian@gmail.com>
 * @URL    : https://github.com/dvlpr1996
 * @License: MIT License Copyright (c) 2022 (until present) Nima jahan bakhshian
 */

declare(strict_types=1);

namespace dvlpr1996\PhpStringHelpers\utility;

use InvalidArgumentException;
use dvlpr1996\PhpStringHelpers\exceptions\UrlIsNotValidException;
use dvlpr1996\PhpStringHelpers\exceptions\FileDoesNotExistsException;
use dvlpr1996\PhpStringHelpers\exceptions\LanguageFileIsNotArrayException;

class StrUtility
{
    /**  @var string regex pattern for regular words pattern */
    const REGULAR_WORDS_PATTERN = '/[^a-zA-Z0-9]/i';

    private function regularWords(string $words)
    {
        return trim(preg_replace(StrUtility::REGULAR_WORDS_PATTERN, ' ', $words));
    }

    /**
     * change words to camel case
     *
     * @param string $words
     * @return string
     */
    public function toCamelCase(string $words): string
    {
        return str_replace(' ', '', lcfirst(ucwords(strtolower($this->regularWords($words)))));
    }

    /**
     * change words to pascal case
     *
     * @param string $words
     * @return string
     */
    public function toPascalCase(string $words): string
    {
        return str_replace(' ', '', ucwords(strtolower($this->regularWords($words))));
    }

    /**
     * change words to kebab case
     *
     * @param string $words
     * @return string
     */
    public function toKebabCase(string $words): string
    {
        return preg_replace('/\s+/', '-', strtolower($this->regularWords($words)));
    }

    /**
     * change words to title case
     *
     * @param string $words
     * @return string
     */
    public function toTitleCase(string $words): string
    {
        return preg_replace('/\s+/', ' ', ucwords(strtolower($this->regularWords($words))));
    }

    /**
     * change words to constant case
     * like foo bar baz change to FOO_BAR_BAZ
     *
     * @param string $words
     * @return string
     */
    public function toConstant(string $words): string
    {
        return preg_replace('/\s+/', '_', strtoupper($this->regularWords($words)));
    }

    /**
     * change words to snake case
     *
     * @param string $words
     * @return string
     */
    public function toSnakeCase(string $words): string
    {
        return preg_replace('/\s+/', '_', strtolower($this->regularWords($words)));
    }

    /**
     * change words to path case like
     * foo bar baz change to foo/bar/baz
     *
     * @param string $words
     * @return string
     */
    public function toPathCase(string $words): string
    {
        return preg_replace('/\s+/', '/', strtolower($this->regularWords($words)));
    }

    /**
     * change words to ada case
     * like foo bar change to Foo_Bar
     *
     * @param string $words
     * @return string
     */
    public function toAdaCase(string $words): string
    {
        return preg_replace('/\s+/', '_', ucwords(strtolower($this->regularWords($words))));
    }

    /**
     * change words to dot notation case
     * like foo bar change to foo.bar
     *
     * @param string $words
     * @return string
     */
    public function dotNotation(string $words): string
    {
        return preg_replace('/\s+/', '.', $this->regularWords($words));
    }

    /**
     * wrapper for htmlspecialchars()
     *
     * @param $data
     * @return string
     */
    public function entitiesWrapper($data): string
    {
        return htmlspecialchars($data ?? '', ENT_QUOTES, 'UTF-8');
    }

    /**
     * change string to slug
     *
     * @param string $string
     * @return string
     */
    public function toSlug(string $string): string
    {
        $string = preg_replace('/[^\pL\d]+/u', '-', $string);
        return strtolower(trim($string, '-'));
    }

    /**
     * remove all blanks
     *
     * @param string $string
     * @return string
     */
    public function rmAllBlanks(string $string): string
    {
        return preg_replace('/\s+/', '', $string);
    }

    /**
     * return alternate string if string param is null
     *
     * @param string|null $string
     * @param string|null $alternate
     * @return string
     * if alternate param is null return not defined strings
     */
    public function alternate(?string $string, string $alternate = null): string
    {
        $returnString = $string ?: $alternate;
        return is_null($returnString) ? 'not defined' : $this->clearString($returnString);
    }

    /**
     * translation methods just for one level
     * create lang folder in root of your project
     * then create wrapper function or method based on documentation
     *
     * @param string $key |
     * <your custom wrapper>('app.title') reference to ./lang/en/app.php and
     * title array key in app.php file
     * @param string $alternative
     * [optional]
     * @return string
     * @throws FileDoesNotExistsException
     * @throws LanguageFileIsNotArrayException
     */
    public function translate(string $key, string $alternative = ''): string|array
    {
        $keys = explode('.', $key);

        $filePath = $this->filePath($keys[0]);

        $data = require $filePath;

        if (!isset($keys[1]))
            return $data;

        $key = $keys[1];

        if (!is_array($data))
            throw new LanguageFileIsNotArrayException('File data should be array');

        if (!key_exists($key, $data))
            return html_entity_decode(htmlentities($alternative));

        return html_entity_decode(htmlentities($data[$key]));
    }

    /**
     * translate Path resolver
     *
     * @param string $baseAppPath
     * base path of your app
     * @param string $dirName
     * @return string
     */
    public function translatePath(string $baseAppPath, string $dirName): string
    {
        return $baseAppPath . '/lang/' . $dirName . '/';
    }

    /**
     * wrap given string with wrapper param
     *
     * @param int|string $string
     * @param string $wrapper
     * @return string
     */
    public function wrapper(int|string $string, int|string $wrapper = '*'): string
    {
        $string = trim((string)$string);
        $wrapper = (string)$wrapper;

        $len = strlen($string) + strlen($wrapper) + strlen($wrapper);
        return str_pad($string, $len, $wrapper, STR_PAD_BOTH);
    }

    /**
     * return path of file
     *
     * @param string $path
     * path to the file from root of the project
     * accept dot notation case
     * @param string $pathExtension
     * [optional] declare file extension default is php file extension
     * @return string
     * @throws FileDoesNotExistsException
     */
    public function filePath(string $path, string $pathExtension = 'php'): string
    {
        $path = str_replace('.', '/', implode('.', explode('.', $path)));

        $filePath = $path . '.' . strtolower($pathExtension);

        if (!is_file($filePath) || !file_exists($filePath))
            throw new FileDoesNotExistsException($filePath . ' Does Not Exist');

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
    public function generatePin(int $length = 4): int
    {
        if ($length < 4 || $length > 12) return 0;

        $min = (int) str_pad('1', $length, '0');
        $max = (int) str_pad('9', $length, '9');

        return mt_rand($min, $max);
    }

    /**
     * clean and safe given string data
     *
     * @param string $data
     * @return string
     */
    public function clearString(string $data): string
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = strip_tags($data);
        $data = preg_replace('/\s+/im', ' ', $data);
        $data = htmlspecialchars($data, ENT_QUOTES, 'UTF-8');

        return $data;
    }

    /**
     * return only string
     * [A-Za-z]
     *
     * @param string $data
     * @return string
     */
    public function pureString(string $data): string
    {
        return $this->rmExtraBlank(trim(preg_replace('/[^\pL]+/', ' ', $data)));
    }

    /**
     * generate random string
     *
     * @param int $size
     * [optional] default is 5
     * @return string
     */
    public function randomChar(int $size = 5): string
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
    public function randomHex(): string
    {
        return '#' . substr(dechex((int)mt_rand() * 16777215), 0, 6);
    }

    /**
     * generate random rgb color
     *
     * @return string
     */
    public function randomRgb(): string
    {
        return mt_rand(0, 255) . '.' . mt_rand(0, 255) . '.' . mt_rand(0, 255);
    }

    /**
     * Remove all types of links
     *
     * @param string $string
     * @return string
     */
    public function rmLink(string $string): string
    {
        $pattern = '[-a-zA-Z0-9+&@#\/%?=~_|$!:,.;]*[A-Za-z0-9+&@#\/%=~_|$.]/i';
        $protocols = 'https?|ftp|file|mailto|tel';

        $string = trim(preg_replace('/(' . $protocols . '):\/?\/?' . $pattern, '', $string));
        $string = preg_replace('/(www|localhost).' . $pattern, '', $string);
        $string = preg_replace('/(\d+\.){3}\d\/?' . $pattern, '', $string);
        $string = preg_replace('/(\d+\.){3}\d\/?/i', '', $string);
        $string = preg_replace('/(\w+\.).' . $pattern, '', $string);

        return $this->rmExtraBlank($string);
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
    public function limitChar(string|int $string, int $length): string
    {
        $string = (string)$string;

        if (strlen($string) <= $length)
            return $string;

        return $this->rmRightChar($string, $length) . '...';
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
    public function generateId(
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
    public function rmNumbers(string $string): string
    {
        $remove_hex = preg_replace('/(\b[xX]|0)[0-9a-fA-F]+/i', ' ', trim($string));
        $remove_decimal = preg_replace('/[\d]/im', ' ', trim($remove_hex));
        return $this->rmExtraBlank($remove_decimal);
    }

    /**
     * remove all characters
     *
     * @param string $string
     * @return string
     */
    public function rmCharacters(string $string): string
    {
        return $this->rmExtraBlank(preg_replace('/[-_a-z\W]+/i', ' ', trim($string)));
    }

    /**
     * remove all extra blanks
     *
     * @param string $string
     * @return string
     */
    public function rmExtraBlank(string $string): string
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
    public function hexToRgb(string $color): ?string
    {
        $hex = trim($color, '#');

        if (strlen($hex) !== 6)
            return null;

        if (!preg_match('/^[0-9ABCDEFabcdef\#]+$/i', $hex))
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
    public function rgbToHex(string $color): ?string
    {
        $rgb = explode('.', $color);

        foreach ($rgb as $value) {
            if (!preg_match('/^[0-9]+$/i', $value))
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
    public function generateAnchor(string|int $content, string $href): string
    {
        $href = filter_var(trim($href), FILTER_SANITIZE_URL);

        if (!filter_var($href, FILTER_VALIDATE_URL))
            throw new UrlIsNotValidException('Url Is Not Valid');

        return '<a href=$href>' . $this->clearString($content) . '</a>';
    }

    /**
     * return encoding of string
     * wrapper for mb_detect_encoding()
     *
     * @param string $string
     * @return string
     */
    public function getEncoding(string $string): string
    {
        return mb_detect_encoding($string, strict: true);
    }

    public function isUtf8(string|array $string): bool
    {
        return mb_check_encoding($string, 'UTF-8');
    }

    /**
     * remove duplicate words
     *
     * @param string $string
     * @return string
     */
    public function rmDuplicateWords(string $string): string
    {
        $string = array_unique(explode(' ', strtolower($string)));
        return $this->rmExtraBlank(implode(' ', $string));
    }

    /**
     * remove characters from right side
     * based on $num param
     *
     * @param string $words
     * @param int $num
     * @return string
     */
    public function rmRightChar(string $words, int $num): string
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
    public function rmLeftChar(string $words, int $num): string
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
    public function rmBothSideChar(string $words, int $num): string
    {
        $words = $this->rmLeftChar($words, $num);
        return $this->rmRightChar($words, $num);
    }

    /**
     * find whether the type of a data is json
     *
     * @param mixed $data
     * @return bool
     * return false if $data is empty or string type or not a valid json
     * otherwise return true
     */
    public function isJson(mixed $data): bool
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
    public function isContains(string $string, string $search, bool $caseSensitive = false): bool
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
    public function isStartWith(string $string, string $search, bool $caseSensitive = false): bool
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
    public function lastWord(string $string): string
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
    public function firstWord(string $string): string
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
    public function getFirstNumbers(string $string): string
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
    public function getLastNumbers(string $string): string
    {
        if (preg_match_all('/\d+\b/', $this->lastWord($string), $numbers))
            return end($numbers[0]);

        return '';
    }

    public function rmBeginningNumbers(string $string): string
    {
        return $this->rmExtraBlank(preg_replace('/\b\d+/i', '', trim($string)));
    }

    public function rmEndingNumbers(string $string): string
    {
        return $this->rmExtraBlank(preg_replace('/\d+\b/i', '', trim($string)));
    }

    public function convertToUtf8(string $string): string|bool
    {
        $converter = iconv(mb_detect_encoding($string, mb_detect_order(), true), 'UTF-8', $string);
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
    public function incrementBy(string $string, ?string $separator = null): string
    {
        $separator = $separator ?: null;
        $numberPart = $this->getLastNumbers($string);
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
    public function decrementBy(string $string, ?string $separator = null): string
    {
        $separator = $separator ?: null;
        $numberPart = $this->getLastNumbers($string);
        $stringPart = rtrim($string, $numberPart);

        if ($numberPart === '')
            $numberPart = 0;

        $numberPart -= 1;

        return $stringPart . $separator . (string)$numberPart;
    }

    /**
     * remove last word from given string
     *
     * @param string $string
     * @return string
     */
    public function rmLastWord(string $string): string
    {
        return preg_replace('/\W\w+\s*(\W*)$/', '$1', trim($string));
    }

    /**
     * remove first word from given string
     *
     * @param string $string
     * @return string
     */
    public function rmFirstWord(string $string): string
    {
        return preg_replace('/^(\w+\s)/', '', trim($string));
    }

    /**
     * find whether the type of a given string is slug
     *
     * @param string $slug
     * @return bool
     */
    public function is_slug(string $slug): bool
    {
        if (!preg_match('/^[\w\d][-\w\d]*$/', trim($slug)))
            return false;
        return true;
    }

    /**
     * find whether the type of a given ip is valid ipv4
     *
     * @param string $ip
     * @return boolean
     */
    public function is_ipv4(string $ip): bool
    {
        if (empty($ip) || !is_string($ip))
            return false;

        $pattern = '/^(([0-9]|[1-9][0-9]|1[0-9][0-9]|2[0-4][0-9]|25[0-5])(\.(?!$)|$)){4}$/';

        if (!preg_match($pattern, trim($ip)))
            return false;
        return true;
    }

    /**
     * find whether the type of a given ip is valid ipv6
     *
     * @param string $ip
     * @return boolean
     */
    public function is_ipv6(string $ip): bool
    {
        if (empty($ip) || !is_string($ip))
            return false;

        $pattern = '
        (([0-9a-fA-F]{1,4}:){7,7}[0-9a-fA-F]{1,4}|([0-9a-fA-F]{1,4}:){1,7}:|([0-9a-fA-F]{1,4}:){1,6}:[0-9a-fA-F]{1,4}|([0-9a-fA-F]{1,4}:){1,5}(:[0-9a-fA-F]{1,4}){1,2}|([0-9a-fA-F]{1,4}:){1,4}(:[0-9a-fA-F]{1,4}){1,3}|([0-9a-fA-F]{1,4}:){1,3}(:[0-9a-fA-F]{1,4}){1,4}|([0-9a-fA-F]{1,4}:){1,2}(:[0-9a-fA-F]{1,4}){1,5}|[0-9a-fA-F]{1,4}:((:[0-9a-fA-F]{1,4}){1,6})|:((:[0-9a-fA-F]{1,4}){1,7}|:)|fe80:(:[0-9a-fA-F]{0,4}){0,4}%[0-9a-zA-Z]{1,}|::(ffff(:0{1,4}){0,1}:){0,1}((25[0-5]|(2[0-4]|1{0,1}[0-9]){0,1}[0-9])\.){3,3}(25[0-5]|(2[0-4]|1{0,1}[0-9]){0,1}[0-9])|([0-9a-fA-F]{1,4}:){1,4}:((25[0-5]|(2[0-4]|1{0,1}[0-9]){0,1}[0-9])\.){3,3}(25[0-5]|(2[0-4]|1{0,1}[0-9]){0,1}[0-9]))
    ';

        if (!preg_match($pattern, trim($ip)))
            return false;
        return true;
    }

    /**
     * Deletes the words before the given $search word
     *
     * @param string $string
     * @param string $search
     * @return string
     */
    public function after(string $string, string $search): string
    {
        if (!$this->checkStringForRemoveOperation($string, $search))
            return $string;
        return $this->rmExtraBlank(explode($search, $string)[1]);
    }

    /**
     * Deletes the words after the given $search word
     *
     * @param string $string
     * @param string $search
     * @return string
     */
    public function before(string $string, string $search): string
    {
        if (!$this->checkStringForRemoveOperation($string, $search))
            return $string;
        return $this->rmExtraBlank(strstr($string, $search, true));
    }

    /**
     * Check String For Any Spaces
     *
     * @param string $string
     * @return bool
     */
    public function hasSpace(string $string): bool
    {
        return (bool) preg_match('/\s/', $string);
    }

    /**
     * a wrapper for FILTER_VALIDATE_EMAIL filter
     *
     * @param string $email
     * @return bool
     */
    public function isEmail(string $email): bool
    {
        return (bool) filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    /**
     * Detect Given Word Case
     *
     * @param mixed $word
     * @return string
     */
    public function detectCase(string $word): string
    {
        if ($this->isLowerCase($word)) return 'lowerCase';
        if ($this->isUpperCase($word)) return 'upperCase';
        if ($this->isTitleCase($word)) return 'titleCase';
        if ($this->isSnakeCase($word)) return 'snakeCase';

        return 'mixedCase';
    }

    /**
     * Find Whether The Type Of A Given Word Is Lower Case
     *
     * @param string $word
     * @return boolean
     */
    public function isLowerCase(string $word): bool
    {
        return preg_match('/^[a-z]+$/', trim($word)) === 1;
    }

    /**
     * Find Whether The Type Of A Given Word Is Upper Case
     *
     * @param string $word
     * @return boolean
     */
    public function isUpperCase(string $word): bool
    {
        return trim($word) === strtoupper($word);
    }

    /**
     * Whether The Type Of A Given Word Is Title Case
     *
     * @param string $word
     * @return boolean
     */
    public function isTitleCase(string $word): bool
    {
        $pattern = '/^(?:\b\p{Lu}\p{Ll}*\b\s*)+$/';
        return preg_match($pattern, trim($word)) === 1;
    }

    /**
     * whether the type of a given Word is SnakeCase
     *
     * @param string $word
     * @return boolean
     */
    public function isSnakeCase(string $word): bool
    {
        return preg_match('/^[a-z]+(_[a-z]+)*$/', trim($word)) === 1;
    }

    /**
     * validateUserName
     *
     * @param string $userName
     * @return boolean
     */
    public function validateUserName(string $userName, int $min = 3, int $max = 20): bool
    {
        return (bool) preg_match('/^[A-Za-z0-9._-]{' . $min . ',' . $max . '}$/i', $userName);
    }

    /**
     * Convert File Size To Human Readable Format.
     *
     * This function converts a given file size to a human-readable format,
     * based on the specified type (e.g., KB, MB, GB).
     *
     * @param int $size The file size to convert, in bytes.
     * @param string $type The type of file size to convert to (e.g., KB, MB, GB).
     * @return string The file size in human-readable format (e.g., "1.25 MB").
     * @throws InvalidArgumentException If the provided type is invalid.
     * @throws InvalidArgumentException If the provided size is negative.
     */
    public function humanFileSize(int $size, string $type = 'KB'): string
    {
        if ($size < 0) {
            throw new InvalidArgumentException('File size cannot be negative');
        }

        if ($size === 0) {
            return '0 B';
        }

        $conversionFactors = [
            'B' => 1,
            'KB' => 1024,
            'MB' => 1024 * 1024,
            'GB' => 1024 * 1024 * 1024,
            'TB' => 1024 * 1024 * 1024 * 1024,
            'PB' => 1024 * 1024 * 1024 * 1024 * 1024,
        ];

        if (!array_key_exists($type, $conversionFactors)) {
            throw new InvalidArgumentException("Invalid type: $type");
        }

        $humanReadableSize = $size / $conversionFactors[$type];

        return number_format($humanReadableSize, 2) . ' ' . $type;
    }

    private function checkStringForRemoveOperation(string $string, string $word): bool
    {
        $string = strtolower(trim($string));
        $word = strtolower(trim($word));

        if (empty($string) || !is_string($string))
            return false;

        if (empty($word) || !is_string($word))
            return false;

        if (!$this->isContains($string, $word))
            return false;

        if (str_ends_with($string, $word))
            return false;

        return true;
    }
}
