<?php

/**
 * @Package: some useful php string helper Functions
 * @Author : Nima jahan bakhshian / dvlpr1996 <nimajahanbakhshian@gmail.com>
 * @URL    : https://github.com/dvlpr1996
 * @License: MIT License Copyright (c) 2022 (until present) Nima jahan bakhshian
 */

declare(strict_types=1);

use PhpStringHelpers\Facade\StrUtility as strHelpers;

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
    function entitiesWrapper($data): string
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

if (!function_exists('rmAllBlanks')) {
    function rmAllBlanks(string $string): string
    {
        return strHelpers::rmAllBlanks($string);
    }
}

if (!function_exists('alternate')) {
    function alternate(?string $string, ?string $alternate = null): string
    {
        return strHelpers::alternate($string, $alternate);
    }
}

if (!function_exists('translate')) {
    function translate(string $key, string $alternative = ''): string|array
    {
        return strHelpers::translate($key, $alternative);
    }
}

if (!function_exists('translatePath')) {
    function translatePath(string $baseAppPath, string $dirName): string
    {
        return strHelpers::translatePath($baseAppPath, $dirName);
    }
}

if (!function_exists('wrapper')) {
    function wrapper(int|string $string, int|string $wrapper = '*'): string
    {
        return strHelpers::wrapper($string, $wrapper);
    }
}

if (!function_exists('filePath')) {
    function filePath(string $path, string $pathExtension = 'php'): string
    {
        return strHelpers::filePath($path, $pathExtension);
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

if (!function_exists('randomChar')) {
    function randomChar(int $size = 5): string
    {
        return strHelpers::randomChar($size);
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

if (!function_exists('rmBothSideChar')) {
    function rmBothSideChar(string $words, int $num): string
    {
        return strHelpers::rmBothSideChar($words, $num);
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

if (!function_exists('rmEndingNumbers')) {
    function rmEndingNumbers(string $string): string
    {
        return strHelpers::rmEndingNumbers($string);
    }
}

if (!function_exists('convertToUtf8')) {
    function convertToUtf8(string $string): string|bool
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

if (!function_exists('rmLastWord')) {
    function rmLastWord(string $string): string
    {
        return strHelpers::rmLastWord($string);
    }
}

if (!function_exists('rmFirstWord')) {
    function rmFirstWord(string $string): string
    {
        return strHelpers::rmFirstWord($string);
    }
}

if (!function_exists('is_slug')) {
    function is_slug(string $slug): bool
    {
        return strHelpers::is_slug($slug);
    }
}

if (!function_exists('is_ipv4')) {
    function is_ipv4(string $ip): bool
    {
        return strHelpers::is_ipv4($ip);
    }
}

if (!function_exists('is_ipv6')) {
    function is_ipv6(string $ip): bool
    {
        return strHelpers::is_ipv6($ip);
    }
}

if (!function_exists('after')) {
    function after(string $string, string $search): string
    {
        return strHelpers::after($string, $search);
    }
}

if (!function_exists('before')) {
    function before(string $string, string $search): string
    {
        return strHelpers::before($string, $search);
    }
}

if (!function_exists('hasSpace')) {
    function hasSpace(string $string): string
    {
        return strHelpers::hasSpace($string);
    }
}

if (!function_exists('isEmail')) {
    function isEmail(string $email): bool
    {
        return strHelpers::isEmail($email);
    }
}

if (!function_exists('detectCase')) {
    function detectCase(string $string): string
    {
        return strHelpers::detectCase($string);
    }
}

if (!function_exists('isLowerCase')) {
    function isLowerCase(string $string): bool
    {
        return strHelpers::isLowerCase($string);
    }
}

if (!function_exists('isUpperCase')) {
    function isUpperCase(string $string): bool
    {
        return strHelpers::isUpperCase($string);
    }
}

if (!function_exists('isTitleCase')) {
    function isTitleCase(string $string): bool
    {
        return strHelpers::isTitleCase($string);
    }
}

if (!function_exists('isSnakeCase')) {
    function isSnakeCase(string $string): bool
    {
        return strHelpers::isSnakeCase($string);
    }
}

if (!function_exists('validateUserName')) {
    function validateUserName(string $userName, int $min = 3, int $max = 20): bool
    {
        return strHelpers::validateUserName($userName, $min, $max);
    }
}

if (!function_exists('humanFileSize')) {
    function humanFileSize(int $size, string $type = 'KB'): string
    {
        return strHelpers::humanFileSize($size, $type);
    }
}
