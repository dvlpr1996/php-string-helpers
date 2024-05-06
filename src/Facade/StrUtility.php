<?php

/**
 * @Package: some useful php string utility methods
 * @Class  : StrUtility
 * @Author : Nima jahan bakhshian / dvlpr1996 <nimajahanbakhshian@gmail.com>
 * @URL    : https://github.com/dvlpr1996
 * @License: MIT License Copyright (c) 2022 (until present) Nima jahan bakhshian
 */

declare(strict_types=1);

namespace dvlpr1996\PhpStringHelpers\Facade;

use dvlpr1996\PhpStringHelpers\Facade\Facade;

/**
 * @method static string toCamelCase(string $words)
 * @method static string toPascalCase(string $words)
 * @method static string toKebabCase(string $words)
 * @method static string toTitleCase(string $words)
 * @method static string toConstant(string $words)
 * @method static string toSnakeCase(string $words)
 * @method static string toPathCase(string $words)
 * @method static string toAdaCase(string $words)
 * @method static string dotNotation(string $words)
 * @method static string entitiesWrapper($data)
 * @method static string toSlug(string $string)
 * @method static string rmAllBlanks(string $string)
 * @method static string alternate(?string $string, string $alternate = null)
 * @method static string|array translate(string $key, string $alternative = '')
 * @method static string wrapper(int|string $string, int|string $wrapper = '*')
 * @method static string filePath(string $path, string $pathExtension = 'php')
 * @method static int generatePin(int $length = 4)
 * @method static string clearString(string $data)
 * @method static string pureString(string $data)
 * @method static string randomChar(int $size = 5)
 * @method static string randomHex()
 * @method static string randomRgb()
 * @method static string rmLink(string $string)
 * @method static string limitChar(string|int $string, int $length)
 * @method static string generateId(string|int $prefix ='',string|int $suffix ='',bool $moreEntropy = false)
 * @method static string rmNumbers(string $string)
 * @method static string rmCharacters(string $string)
 * @method static string rmExtraBlank(string $string)
 * @method static ?string hexToRgb(string $color)
 * @method static ?string rgbToHex(string $color)
 * @method static string generateAnchor(string|int $content, string $href)
 * @method static string getEncoding(string $string)
 * @method static bool isUtf8(string|array $string)
 * @method static string rmDuplicateWords(string $string)
 * @method static string rmRightChar(string $words, int $num)
 * @method static string rmLeftChar(string $words, int $num)
 * @method static string rmBothSideChar(string $words, int $num)
 * @method static bool isJson(mixed $data)
 * @method static bool isContains(string $string, string $search, bool $caseSensitive = false)
 * @method static bool isStartWith(string $string, string $search, bool $caseSensitive = false)
 * @method static string lastWord(string $string)
 * @method static string firstWord(string $string)
 * @method static string getFirstNumbers(string $string)
 * @method static string getLastNumbers(string $string)
 * @method static string rmBeginningNumbers(string $string)
 * @method static string rmEndingNumbers(string $string)
 * @method static string|bool convertToUtf8(string $string)
 * @method static string incrementBy(string $string, ?string $separator = null)
 * @method static string decrementBy(string $string, ?string $separator = null)
 * @method static string rmLastWord(string $string)
 * @method static string rmFirstWord(string $string)
 * @method static bool is_slug(string $slug)
 * @method static bool is_ipv4(string $ip)
 * @method static bool is_ipv6(string $ip)
 * @method static string after(string $string, string $search)
 * @method static string before(string $string, string $search)
 * @method static bool hasSpace(string $string)
 * @method static bool isEmail(string $email)
 * @method static string detectCase(string $word)
 * @method static bool isLowerCase(string $word)
 * @method static bool isUpperCase(string $word)
 * @method static bool isTitleCase(string $word)
 * @method static bool isSnakeCase(string $word)
 * @method static bool validateUserName(string $userName, int $min = 3, int $max = 20)
 * @method static string humanFileSize(int $size, string $type = 'KB')
 */

class StrUtility extends Facade
{
    protected static $getFacadeName = 'dvlpr1996\PhpStringHelpers\utility\StrUtility';
}
