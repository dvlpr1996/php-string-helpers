# helpful set of PHP string helper functions & utilities class


[![License: MIT](https://img.shields.io/badge/License-MIT-green.svg)](https://opensource.org/licenses/MIT)
[![Latest Version on Packagist](https://img.shields.io/packagist/v/dvlpr1996/php-string-helpers?style=flat)](https://packagist.org/packages/dvlpr1996/php-string-helpers)
[![Total Downloads](https://img.shields.io/packagist/dt/dvlpr1996/php-string-helpers)](https://packagist.org/packages/dvlpr1996/php-string-helpers)

All function helpers will be enabled by default (if those functions haven't already been defined).
also you can use them as utilities class.

## Requirements

- PHP 8 or higher

## Installation

You can install the package via composer:

```bash
composer require dvlpr1996/php-string-helpers
```

## StrUtility usage

String helper methods are static so usage like the following:
First Using The StrUtility Class:

```php
use PhpStringHelpers\utility\StrUtility;
```

<br>

- change words to camel case

```php
StrUtility::toCamelCase(string $words): string
```

- change words to pascal case

```php
StrUtility::toPascalCase(string $words): string
```

- change words to kebab case

```php    
StrUtility::toKebabCase(string $words): string
```

- change words to title case

```php     
StrUtility::toTitleCase(string $words): string
```

- change words to constant case | foo bar baz change to FOO_BAR_BAZ

```php     
StrUtility::toConstant(string $words): string
```

- change words to snake case

```php     
StrUtility::toSnakeCase(string $words): string  
```

- change words to path case | foo bar baz change to foo/bar/baz

```php   
StrUtility::toPathCase(string $words): string
```

- change words to ada case | foo bar change to Foo_Bar

```php     
StrUtility::toAdaCase(string $words): string
```

- change words to dot notation case | foo bar change to foo.bar

```php     
StrUtility::dotNotation(string $words): string  
```

- wrapper for htmlspecialchars()

```php   
StrUtility::entitiesWrapper($data): string
```

- change string to slug

```php     
StrUtility::toSlug(string $string): string
```

- remove all blanks

```php     
StrUtility::rmAllBlanks(string $string): string     
```

- return alternate string if string param is null

```php
StrUtility::alternate(?string $string, string $alternate = null): string    
```

- translation methods, for using this method you should create a wrapper function 
for example 

```
function <your_wrapper_function_name>(string $key, string $replace = '', string $dirName = 'en')
{
    $BASE_PATH = // base (root) path of your project

    $translatePath = StrUtility::translatePath($BASE_PATH, $dirName);
    return StrUtility::translate($translatePath . $key, $replace);
}
```

< your_wrapper_function_name>('app.title') reference to lang/en/app.php and title array key in app.php
file app.php must only return associative array.

```php
StrUtility::translate(string $key, string $replace = '', string $dirName = 'en'): string
```

- wrap given string with wrapper param

```php
StrUtility::wrapper(int|string $string, int|string $wrapper = '*'): string
```

- return path of file

```php
StrUtility::filePath(string $path, string $pathExtension = 'php'): string
```

- generate unique pin numbers between 4 digit and 12 digit

```php
StrUtility::generatePin(int $length = 4): int
```

- clean and safe given string data

```php
StrUtility::clearString(string $data): string
```

- return only string and remove other characters

```php
StrUtility::pureString(string $data): string
```

- generate random string

```php
StrUtility::randomChar(int $size = 5): string  
```

- generate random hexadecimal color

```php
StrUtility::randomHex(): string
```

- generate random rgb color

```php
StrUtility::randomRgb(): string
```

- Remove all types of links

```php
StrUtility::rmLink(string $string): string
```

- limit character based on $length and replace theme with ...

```php
StrUtility::limitChar(string|int $string, int $length): string
```

- generate unique id numbers

```php
StrUtility::generateId(string|int $prefix ='',string|int $suffix ='',bool $moreEntropy = false): string   
```

- remove all numbers


```php
StrUtility::rmNumbers(string $string): string   
```

- remove all characters

```php
StrUtility::rmCharacters(string $string): string
```

- remove all extra blanks

```php
StrUtility::rmExtraBlank(string $string): string 
```

- convert hex color to rgb color

```php
StrUtility::hexToRgb(string $color): ?string 
```

- convert rgb color to hex color

```php
StrUtility::rgbToHex(string $color): ?string
```

- generate \<a\> tag link

```php
StrUtility::generateAnchor(string|int $content, string $href): string
```

- return encoding of string . wrapper for mb_detect_encoding()

```php
StrUtility::getEncoding(string $string): string
```

```php
StrUtility::isUtf8(string|array $string): bool
```

- remove duplicate words

```php
StrUtility::rmDuplicateWords(string $string): string
```

- remove characters from right side based on $num param

```php
StrUtility::rmRightChar(string $words, int $num): string
```

- remove characters from left side based on $num param

```php
StrUtility::rmLeftChar(string $words, int $num): string
```

- remove characters from both side based on $num param

```php
StrUtility::rmBothSideChar(string $words, int $num): string
```

- find whether the type of a data is json

```php
StrUtility::isJson(mixed $data): bool
```

- Checks whether the string contains the specified value or not

```php
StrUtility::isContains(string $string, string $search, bool $caseSensitive = false): bool
```

- Checks whether the string starts with the specified value <$search> or not

```php
StrUtility::isStartWith(string $string, string $search, bool $caseSensitive = false): bool
```

- return the last word

```php
StrUtility::lastWord(string $string): string
```

- return the first word

```php
StrUtility::firstWord(string $string): string
```

- return the first number

```php
StrUtility::getFirstNumbers(string $string): string
```

- return the last number

```php
StrUtility::getLastNumbers(string $string): string
```

```php
StrUtility::rmBeginningNumbers(string $string): string
```

```php
StrUtility::rmEndingNumbers(string $string): string
```

```php
StrUtility::convertToUtf8(string $string): string|bool
```

- incrementing the numbers of the end of the string

```php
StrUtility::incrementBy(string $string, ?string $separator = null): string
```

- decrementing the numbers of the end of the string

```php
StrUtility::decrementBy(string $string, ?string $separator = null): string
```

- remove last word from given string 

```php
StrUtility::rmLastWord(string $string): string
```

- remove first word from given string

```php
StrUtility::rmFirstWord(string $string): string
```

- find whether the type of a given string is slug

```php
StrUtility::is_slug(string $slug): bool
```
## PhpStringHelpers usage

String helper functions are global so usage like the following:

```php
decrementBy(string $string, ?string $separator = null): string
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## issues

If you discover any issues, please using the issue tracker.

## Credits

-   [Nima jahan bakhshian](https://github.com/dvlpr1996)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
