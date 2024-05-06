# Changelog

All notable changes to `dvlpr1996/php-string-helpers` will be documented in this file

## 3.0.0(2024-05-06)

### Added
Add new methods

- StrUtility::isEmail(string $email): bool
- StrUtility::detectCase(string $word): string
- StrUtility::isLowerCase(string $word): bool
- StrUtility::isUpperCase(string $word): bool
- StrUtility::isTitleCase(string $word): bool
- StrUtility::isSnakeCase(string $word): bool
- StrUtility::validateUserName(string $userName, int $min = 3, int $max = 20): bool
- StrUtility::humanFileSize(int $size, string $type = 'KB'): string


### Changed
- Updated composer.json schema for namespaces to improve package organization.

### Deprecated
None

### Removed
None

### Fixed
None

### Security
None

## 2.0.1(2023-05-22)

fix StrUtility::translate() method bug

## 2.0.0 (2023-01-18)

Change the implementation of package structure now user can use this library in 3 different ways

- StrUtility usage as object
- StrUtility usage as helper functions
- StrUtility usage as static methods

Add new methods : 

- StrUtility::is_ipv4(string $ip): bool
- StrUtility::is_ipv6(string $ip): bool
- StrUtility::after(string $string, string $search): string
- StrUtility::before(string $string, string $search): string

## 1.0.0 (2022-12-18)

Add new methods : 

- StrUtility::rmLastWord(string $string)

- StrUtility::rmFirstWord(string $string)

- StrUtility::is_slug(string $slug)

Change how to use StrUtility::translate() and StrUtility::filePath()

Improve display of errors

## 0.1.1 (2022-12-05)

- fix project root path bug in translate() and filePath()

## 0.1.0 (2022-11-23)

- initial release
