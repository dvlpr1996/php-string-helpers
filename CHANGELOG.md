# Changelog

All notable changes to `dvlpr1996/php-string-helpers` will be documented in this file

## 2.0.0 (2023-01-dd)

- Change the implementation of package structure

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
