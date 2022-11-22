<?php

declare(strict_types=1);

namespace PhpStringHelpers\Tests;

use PHPUnit\Framework\TestCase;
use PhpStringHelpers\exceptions\UrlIsNotValidException;
use PhpStringHelpers\utility\StrUtility as strHelpersTest;
use PhpStringHelpers\exceptions\FileDoesNotExistsException;
use PhpStringHelpers\exceptions\LanguageFileIsNotArrayException;

/**
 * @covers StrUtility
 */
class StrUtilityTest extends TestCase
{
    public $sampleText = 'somE TexT 444 for? tE34st! @#56$%^ <>';

    public function testToCamelCaseCanReturnStringValue()
    {
        $string = strHelpersTest::toCamelCase($this->sampleText);
        $this->assertIsString($string);
    }

    public function testToCamelCaseCanReturnsStringLikeCamelCase()
    {
        $string = strHelpersTest::toCamelCase($this->sampleText);
        $this->assertEquals('someText444ForTe34st56', $string);
    }

    public function testToPascalCaseCanReturnStringValue()
    {
        $string = strHelpersTest::toPascalCase($this->sampleText);
        $this->assertIsString($string);
    }

    public function testToPascalCaseCanReturnsStringLikePascalCase()
    {
        $string = strHelpersTest::toPascalCase($this->sampleText);
        $this->assertEquals('SomeText444ForTe34st56', $string);
    }

    public function testToKebabCaseCanReturnStringValue()
    {
        $string = strHelpersTest::toKebabCase($this->sampleText);
        $this->assertIsString($string);
    }

    public function testToKebabCaseCanReturnsStringLikeKebabCase()
    {
        $string = strHelpersTest::toKebabCase($this->sampleText);
        $this->assertEquals('some-text-444-for-te34st-56', $string);
    }

    public function testToTitleCaseCanReturnStringValue()
    {
        $string = strHelpersTest::toTitleCase($this->sampleText);
        $this->assertIsString($string);
    }

    public function testToTitleCaseCanReturnsStringLikeTitleCase()
    {
        $string = strHelpersTest::toTitleCase($this->sampleText);
        $this->assertEquals('Some Text 444 For Te34st 56', $string);
    }

    public function testToConstantCanReturnStringValue()
    {
        $string = strHelpersTest::toConstant($this->sampleText);
        $this->assertIsString($string);
    }

    public function testToConstantCanReturnStringLikeConstantCase()
    {
        $string = strHelpersTest::toConstant($this->sampleText);
        $this->assertEquals('SOME_TEXT_444_FOR_TE34ST_56', $string);
    }

    public function testToSnakeCaseCanReturnStringValue()
    {
        $string = strHelpersTest::toSnakeCase($this->sampleText);
        $this->assertIsString($string);
    }

    public function testToSnakeCaseCanReturnStringLikeSnakeCase()
    {
        $string = strHelpersTest::toSnakeCase($this->sampleText);
        $this->assertEquals('some_text_444_for_te34st_56', $string);
    }

    public function testToPathCaseCanReturnStringValue()
    {
        $string = strHelpersTest::toPathCase($this->sampleText);
        $this->assertIsString($string);
    }

    public function testToPathCaseCanReturnStringLikePathCase()
    {
        $string = strHelpersTest::toPathCase($this->sampleText);
        $this->assertEquals('some/text/444/for/te34st/56', $string);
    }

    public function testToAdaCaseCanReturnStringValue()
    {
        $string = strHelpersTest::toAdaCase($this->sampleText);
        $this->assertIsString($string);
    }

    public function testToAdaCaseCanReturnStringLikeAdaCase()
    {
        $string = strHelpersTest::toAdaCase($this->sampleText);
        $this->assertEquals('Some_Text_444_For_Te34st_56', $string);
    }

    public function testDotNotationCanReturnStringValue()
    {
        $string = strHelpersTest::dotNotation($this->sampleText);
        $this->assertIsString($string);
    }

    public function testDotNotationCanReturnStringLikeDotNotation()
    {
        $string = strHelpersTest::dotNotation($this->sampleText);
        $this->assertEquals('some.text.444.for.te34st.56', $string);
    }

    public function testEntitiesWrapperCanReturnStringValue()
    {
        $string = strHelpersTest::entitiesWrapper($this->sampleText);
        $this->assertIsString($string);
    }

    public function testEntitiesWrapperCanReturnEmptyStringIfGivenDataIsNull()
    {
        $string = strHelpersTest::entitiesWrapper(null);
        $this->assertEquals('', $string);
    }

    public function testToSlugCanReturnStringValue()
    {
        $string = strHelpersTest::toSlug($this->sampleText);
        $this->assertIsString($string);
    }

    public function testToSlugCanReturnStringLikeRegularSlug()
    {
        $string = strHelpersTest::toSlug($this->sampleText);
        $this->assertMatchesRegularExpression('/^[a-z0-9]+(?:-[a-z0-9]+)*$/im', $string);
        $this->assertEquals('some-text-444-for-te34st-56', $string);
    }

    public function testClearStringCanReturnStringValue()
    {
        $string = strHelpersTest::clearString($this->sampleText);
        $this->assertIsString($string);
    }

    public function testClearStringCanReturnSafeString(): void
    {
        $string = 'Some$ te%st @teXt l!k# 456 @#$ !-_.*+={[( <script> alert("aleRt TeXt")</script>';
        $clearStringResults = strHelpersTest::clearString($string);
        $this->assertMatchesRegularExpression('/[\w\d]+/', $clearStringResults);
    }

    public function testRmAllBlanksCanReturnStringValue()
    {
        $string = strHelpersTest::rmAllBlanks($this->sampleText);
        $this->assertIsString($string);
    }

    public function testRmAllBlanksCanRemoveAllBlanksFromString()
    {
        $string = strHelpersTest::rmAllBlanks($this->sampleText);
        $this->assertNotSame($this->sampleText, $string);
        $this->assertMatchesRegularExpression('/[^\s]/', $string);
    }

    public function testAlternateCanReturnStringValueIfBothParamsSet()
    {
        $string = strHelpersTest::alternate('lorem ipsum', 'dolor site');
        $this->assertIsString($string);
    }

    public function testAlternateCanReturnStringValueIfStringParamIsNull()
    {
        $string = strHelpersTest::alternate(null, 'dolor site');
        $this->assertIsString($string);
    }

    public function testAlternateCanReturnStringValueIfAlternateParamIsNull()
    {
        $string = strHelpersTest::alternate('lorem ipsum', null);
        $this->assertIsString($string);
    }

    public function testAlternateCanReturnStringValueIfBothParamAreNull()
    {
        $string = strHelpersTest::alternate(null, null);
        $this->assertIsString($string);
        $this->assertEquals('not defined', $string);
    }

    public function testTranslateCanReturnStringData()
    {
        $string = strHelpersTest::translate('auth.user_name');
        $this->assertIsString($string);
    }

    public function testTranslateCanThrowExceptionIfLangFileDoesNotExists()
    {
        $this->expectException(FileDoesNotExistsException::class);
        $string = strHelpersTest::translate('validation.first_name');
    }

    public function testTranslateCanThrowExceptionIfLangFileDoesNotInArrayType()
    {
        $this->expectException(LanguageFileIsNotArrayException::class);
        $string = strHelpersTest::translate('app.title');
    }

    public function testTranslateCanReturnReplaceParamIfKeyDoesNotExists()
    {
        $string = strHelpersTest::translate('app.Title', 'laravel');
        $this->assertEquals('laravel', $string);
    }

    public function testFilePathCanReturnStringValue()
    {
        $filePath = strHelpersTest::filePath('lang.en.auth.auth');
        $this->assertIsString($filePath);
    }

    public function testFilePathReturnedFilePathIsExists()
    {
        $filePath = strHelpersTest::filePath('lang.en.auth.auth');
        $this->assertFileExists($filePath);
        $this->assertFileEquals('lang/en/auth/auth.php', $filePath);
        $this->assertFileIsReadable($filePath);
    }

    public function testPathThrowAnExceptionsIfFileDoesNotExists()
    {
        $this->expectException(FileDoesNotExistsException::class);
        $filePath = strHelpersTest::filePath('lang.en.config.auth');
    }

    public function testWrapperCanReturnStringValue()
    {
        $string = strHelpersTest::wrapper("foo bar", "*");
        $this->assertIsString($string);
    }

    public function testWrapperCanReturnStringValueIfStringParamIsInt()
    {
        $string = strHelpersTest::wrapper(123456, "*");
        $this->assertIsString($string);
    }

    public function testWrapperCanWrappingStringParam()
    {
        $string = strHelpersTest::wrapper('foo', "*-*");
        $this->assertEquals('*-*foo*-*', $string);
    }

    public function testGeneratePinCanReturnsIntegerValue()
    {
        $pin = strHelpersTest::generatePin();
        $this->assertIsInt($pin);
    }

    public function testGeneratePinLengthParamIsGreaterThanFour()
    {
        $length = 4;
        strHelpersTest::generatePin($length);
        $this->assertGreaterThanOrEqual(4, $length);
    }

    public function testGeneratePinLengthParamIsLessThanTwelve()
    {
        $length = 12;
        strHelpersTest::generatePin($length);
        $this->assertLessThanOrEqual(12, $length);
    }

    public function testGeneratePinReturnZeroIfLengthParamIsNotInRange()
    {
        $pin = strHelpersTest::generatePin(24);
        $this->assertEquals(0, $pin);
    }

    public function testRandomCharCanReturnStringValue()
    {
        $string = strHelpersTest::randomChar();
        $this->assertIsString($string);
    }

    public function testRandomHexCanReturnStringValue()
    {
        $string = strHelpersTest::randomHex();
        $this->assertIsString($string);
    }

    public function testRandomHexReturnValueStartsWithPoundSign()
    {
        $string = strHelpersTest::randomHex();
        $this->assertStringStartsWith('#', $string);
    }

    public function testRandomHexReturnValueIsValidHex()
    {
        $string = strHelpersTest::randomHex();
        $this->assertEquals(7, strlen($string));
        $this->assertMatchesRegularExpression('/^[0-9ABCDEFabcdef#]+$/i', $string);
    }

    public function testRandomRgbCanReturnStringValue()
    {
        $string = strHelpersTest::randomRgb();
        $this->assertIsString($string);
    }

    public function testRandomRgbReturnValueIsValidRgb()
    {
        $string = strHelpersTest::randomRgb();
        $this->assertMatchesRegularExpression('/^[0-9.]+$/i', $string);
    }

    public function testRmLinkCanReturnStringValue()
    {
        $string = strHelpersTest::rmLink('lorem www.github.com ipsum site');
        $this->assertIsString($string);
    }

    public function testRmLinkCanRemoveAllLinks()
    {
        $inputs = [
            'lorem 127.0.0.1 ipsum site',
            'lorem github.com ipsum site',
            'lorem www.github.com ipsum site',
            'lorem http://www.github.com/ ipsum site',
            'lorem localhost/profile/user/1 ipsum site',
            'lorem 127.0.0.1/profile/user/1 ipsum site',
            'lorem tech.com/articles/text.pdf ipsum site',
            'lorem localhost:8080/profile/user/1 ipsum site',
            'lorem ftp://ftp.example.com/public/example.txt ipsum site www.github.com'
        ];

        foreach ($inputs as $input) {
            $string = strHelpersTest::rmLink($input);
            $this->assertEquals('lorem ipsum site', $string);
        }
    }

    public function testLimitCharCanReturnStringValue()
    {
        $string = strHelpersTest::limitChar('foo bar', 5);
        $this->assertIsString($string);
    }

    public function testLimitCharCanLimitGivenString()
    {
        $string = strHelpersTest::limitChar('foo bar', 2);
        $this->assertEquals('foo b...',$string);
    }

    public function testLimitCharCanReturnGivenStringIfLengthParamIsBiggerThanStringLength()
    {
        $string = strHelpersTest::limitChar('foo bar', 8);
        $this->assertEquals('foo bar',$string);
    }

    public function testGenerateIdCanReturnStringValue()
    {
        $string = strHelpersTest::generateId();
        $this->assertIsString($string);
        $this->assertMatchesRegularExpression('/^[0-9a-zA-Z-]+/i', $string);
    }

    public function testRmNumbersCanReturnStringValue()
    {
        $string = strHelpersTest::rmNumbers($this->sampleText);
        $this->assertIsString($string);
        $this->assertMatchesRegularExpression('/^[\w\W]+$/i', $string);
    }

    public function testRmNumbersReturnEmptyStringIfGivenNumericStringParam()
    {
        $string = strHelpersTest::rmNumbers("0123456789");
        $this->assertEquals('', $string);
    }

    public function testRmCharactersCanReturnStringValue()
    {
        $string = strHelpersTest::rmCharacters($this->sampleText);
        $this->assertIsString($string);
        $this->assertMatchesRegularExpression('/[-_a-zA-Z\W]+/i', $string);
    }

    public function testRmCharactersReturnEmptyStringIfGivenEmptyStringParam()
    {
        $string = strHelpersTest::rmCharacters('');
        $this->assertEquals('', $string);
    }

    public function testRmExtraBlankCanReturnStringValue()
    {
        $string = strHelpersTest::rmExtraBlank($this->sampleText);
        $this->assertIsString($string);
    }

    public function testRmExtraBlankReturnEmptyStringIfGivenEmptyStringParam()
    {
        $string = strHelpersTest::rmExtraBlank('');
        $this->assertEquals('', $string);
    }

    public function testHexToRgbCanReturnStringValueIfColorParamIsValid()
    {
        $color = strHelpersTest::hexToRgb('#bada55');
        $this->assertIsString($color);
    }

    public function testHexToRgbCanReturnNullValueIfColorParamIsNotValid()
    {
        $color = strHelpersTest::hexToRgb('#bada4r');
        $this->assertNull($color);
    }

    public function testHexToRgbCanReturnValidRgbColor()
    {
        $color = strHelpersTest::hexToRgb('#bada44');
        $this->assertMatchesRegularExpression('/^[0-9.]+$/i', $color);
    }

    public function testRgbToHexCanReturnStringValueIfColorParamIsValid()
    {
        $color = strHelpersTest::rgbToHex('250.230.100');
        $this->assertIsString($color);
    }

    public function testRgbToHexCanReturnNullValueIfColorParamIsNotValid()
    {
        $color = strHelpersTest::rgbToHex('25a.23b.100');
        $this->assertNull($color);
    }

    public function testRgbToHexCanReturnValidHexColor()
    {
        $color = strHelpersTest::rgbToHex('250.230.100');
        $this->assertEquals(7, strlen($color));
        $this->assertMatchesRegularExpression('/^[0-9ABCDEFabcdef#]+$/i', $color);
        $this->assertStringStartsWith('#', $color);
    }

    public function testGenerateAnchorCanReturnStringValue()
    {
        $anchorText = strHelpersTest::generateAnchor('example link', 'https://github.com/');
        $this->assertIsString($anchorText);
    }

    public function testGenerateAnchorCanThrowExceptionIfHrefParamIsNotValid()
    {
        $this->expectException(UrlIsNotValidException::class);
        strHelpersTest::generateAnchor('example link', '12github.#$co');
    }

    public function testGetEncodingCanReturnStringValue()
    {
        $string = strHelpersTest::getEncoding('foo bar baz');
        $this->assertIsString($string);
    }

    public function testIsUtf8CanReturnBoolValue()
    {
        $string = strHelpersTest::isUtf8('foo bar baz');
        $this->assertIsBool($string);
    }

    public function testIsUtf8CanReturnTrueWhenGivenUtf8Encoding()
    {
        $string = strHelpersTest::isUtf8('foo bar baz');
        $this->assertIsBool($string);
        $this->assertTrue($string);
    }

    public function testRmDuplicateWordsCanReturnStringValue()
    {
        $string = "lorem ipsum dolor site amet loreM SITE";
        $string = strHelpersTest::rmDuplicateWords($string);
        $this->assertIsString($string);
    }

    public function testRmRightCharCanReturnStringValue()
    {
        $string = strHelpersTest::rmRightChar('foo bar', 2);
        $this->assertIsString($string);
    }

    public function testRmRightCharCanReturnWordsParamIfNumParamIsGreaterThanWordsParamLength()
    {
        $testString = 'foo bar';
        $stringLength = strlen($testString);
        $num = $stringLength + 5;
        $string = strHelpersTest::rmRightChar($testString, $num);

        $this->assertEquals($testString, $string);
    }

    public function testRmRightCharCanRemoveCharacterFromRightSideOfStringBaseOnNumParam()
    {
        $num = 2;
        $string = 'foo bar';
        $stringLength = strlen($string);
        $string = strHelpersTest::rmRightChar($string, $num);

        $this->assertEquals($stringLength - $num, strlen($string));
        $this->assertStringEndsWith($string, 'foo b');
    }

    public function testRmLeftCharCanReturnStringValue()
    {
        $string = strHelpersTest::rmLeftChar('foo bar', 2);
        $this->assertIsString($string);
    }

    public function testRmLeftCharCanRemoveCharacterFromLeftSideOfStringBaseOnNumParam()
    {
        $num = 2;
        $string = 'foo bar';
        $stringLength = strlen($string);
        $string = strHelpersTest::rmLeftChar($string, $num);

        $this->assertEquals($stringLength - $num, strlen($string));
        $this->assertStringStartsWith($string, 'o bar');
    }

    public function testRmLeftCharCanReturnWordsParamIfNumParamIsGreaterThanWordsParamLength()
    {
        $testString = 'foo bar';
        $stringLength = strlen($testString);
        $num = $stringLength + 5;
        $string = strHelpersTest::rmLeftChar($testString, $num);

        $this->assertEquals($testString, $string);
    }

    public function testRmBothSideCharCanReturnStringValue()
    {
        $string = strHelpersTest::rmBothSideChar('foo bar', 2);
        $this->assertIsString($string);
    }

    public function testRmBothSideCharCanRemoveCharacterFromBothSideOfStringBaseOnNumParam()
    {
        $num = 2;
        $string = 'foo bar';
        $stringLength = strlen($string);
        $string = strHelpersTest::rmBothSideChar($string, $num);

        $this->assertEquals($stringLength - $num * 2, strlen($string));
        $this->assertStringStartsWith($string, 'o b');
    }

    public function testIsJsonCanReturnBoolValue()
    {
        $result = strHelpersTest::isJson('{"name":"john"}');
        $this->assertIsBool($result);
    }

    public function testIsJsonCanReturnFalseIfGivenDataIsNotAJsonType()
    {
        $result = strHelpersTest::isJson('["name"=>"john"]');
        $this->assertTrue(!$result);
    }

    public function testIsJsonCanReturnsFalseIfGivenDataIsEmpty()
    {
        $result = strHelpersTest::isJson([]);
        $this->assertTrue(!$result);
    }

    public function testIsJsonCanReturnsFalseIfGivenDataIsString()
    {
        $result = strHelpersTest::isJson('foo');
        $this->assertTrue(!$result);
    }

    public function testPureStringCanReturnStringValue()
    {
        $string = strHelpersTest::pureString($this->sampleText);
        $this->assertIsString($string);
    }

    public function testPureStringCanReturnOnlyString()
    {
        $string = strHelpersTest::pureString($this->sampleText);
        $this->assertMatchesRegularExpression('/[A-Za-z]+$/i', $string);
    }

    public function testIsContainsCanReturnBooleanValue()
    {
        $string = strHelpersTest::isContains('foo bar', 'foo');
        $this->assertIsBool($string);
    }

    public function testIsContainsCanReturnTrueIfSearchParamIsExistsInGivenStringParam()
    {
        $string = strHelpersTest::isContains('foo bar', 'foo');
        $this->assertTrue($string);
    }

    public function testIsContainsCanReturnFalseIfSearchParamIsNotExistsInGivenStringParam()
    {
        $string = strHelpersTest::isContains('foo bar', 'baz');
        $this->assertTrue(!$string);
    }

    public function testIsContainsCanReturnBooleanValueInCaseSensitiveIsTrue()
    {
        $string = strHelpersTest::isContains('foo bar', 'Foo', true);
        $this->assertIsBool($string);
    }

    public function testIsContainsCanReturnTrueIfSearchParamIsExistsInGivenStringParamInCaseSensitiveIsTrue()
    {
        $string = strHelpersTest::isContains('FOo bar', 'FOo', true);
        $this->assertTrue($string);
    }

    public function testIsContainsCanReturnFalseIfSearchParamIsNotExistsInGivenStringParamInCaseSensitiveIsTrue()
    {
        $string = strHelpersTest::isContains('foo bar', 'baz', true);
        $this->assertTrue(!$string);
    }

    public function testIsContainsCanReturnFalseSearchOrStringParamsAreEmpty()
    {
        $string = strHelpersTest::isContains('foo bar', '');
        $this->assertTrue(!$string);
    }

    public function testIsStartWithCanReturnBooValue()
    {
        $string = strHelpersTest::isStartWith('foo', 'f');
        $this->assertIsBool($string);
    }

    public function testIsStartWithCanReturnTrueIfGivenStringStartWithSearchParam()
    {
        $string = strHelpersTest::isStartWith('foo', 'f');
        $this->assertTrue($string);
    }

    public function testIsStartWithCanReturnFalseIfStringOrSearchParamIsEmpty()
    {
        $string = strHelpersTest::isStartWith('', '');
        $this->assertTrue(!$string);
    }

    public function testLastWordCanReturnStringValue()
    {
        $lastWord = strHelpersTest::lastWord('foo bar baz');
        $this->assertIsString($lastWord);
    }

    public function testLastWordCanReturnLastWordOfGivenString()
    {
        $lastWord = strHelpersTest::lastWord('baz');
        $this->assertStringEndsWith('baz', $lastWord);
    }

    public function testLastWordCanReturnEmptyStringInGivenEmptyString()
    {
        $lastWord = strHelpersTest::lastWord('');
        $this->assertEquals('', $lastWord);
    }

    public function testFirstWordCanReturnStringValue()
    {
        $firstWord = strHelpersTest::firstWord('foo bar baz');
        $this->assertIsString($firstWord);
    }

    public function testFirstWordCanReturnFirstWordOfGivenString()
    {
        $firstWord = strHelpersTest::firstWord('foo bar baz');
        $this->assertStringEndsWith('foo', $firstWord);
    }

    public function testFirstWordCanReturnEmptyStringInGivenEmptyString()
    {
        $firstWord = strHelpersTest::firstWord('');
        $this->assertEquals('', $firstWord);
    }

    public function testGetFirstNumbersCanReturnStringValue()
    {
        $firstNumber = strHelpersTest::getFirstNumbers('2bar0 2foo 2baz');
        $this->assertIsString($firstNumber);
    }

    public function testGetFirstNumbersCanReturnEmptyStringIfGivenStringParamDoesNotStartWithNumber()
    {
        $firstNumber = strHelpersTest::getFirstNumbers('bar5 2foo 3baz');
        $this->assertEquals('', $firstNumber);
    }

    public function testGetLastNumbersCanReturnStringValue()
    {
        $lastNumber = strHelpersTest::getLastNumbers('2bar0 2foo 2baz545');
        $this->assertIsString($lastNumber);
    }

    public function testGetLastNumbersCanReturnEmptyStringIfGivenStringParamDoesNotEndingWithNumber()
    {
        $lastNumber = strHelpersTest::getLastNumbers('bar5 2foo 3baz');
        $this->assertEquals('', $lastNumber);
    }

    public function testGetLastNumbersCanReturnEmptyStringIfGivenStringParamIsEmpty()
    {
        $lastNumber = strHelpersTest::getLastNumbers('');
        $this->assertEquals('', $lastNumber);
    }

    public function testRmBeginningNumbersCanReturnStringValue()
    {
        $string = strHelpersTest::rmBeginningNumbers('2bar0 2foo 2baz545');
        $this->assertIsString($string);
    }

    public function testRmBeginningNumbersCanRemoveNumbersFromTheBeginningOfWords()
    {
        $string = strHelpersTest::rmBeginningNumbers('5foo 66b5ar88 555 321b1az321');
        $this->assertEquals('foo b5ar88 b1az321', $string);
    }

    public function testRmEndingNumbersCanReturnStringValue()
    {
        $string = strHelpersTest::rmEndingNumbers('2bar0 2foo 2baz545');
        $this->assertIsString($string);
    }

    public function testRmEndingNumbersCanRemoveNumbersFromEndingOfWords()
    {
        $string = strHelpersTest::rmEndingNumbers('5foo 66b5ar55 555 321b1az321');
        $this->assertEquals('5foo 66b5ar 321b1az', $string);
    }

    public function testConvertToUtf8CanReturnStringValue()
    {
        $string = strHelpersTest::convertToUtf8('bar foo baz');
        $this->assertIsString($string);
    }

    public function testConvertToUtf8CanReturnFalseValueIfCanNotConvert()
    {
        $string = strHelpersTest::convertToUtf8('');
        $this->assertTrue(!$string);
    }

    public function testIncrementByCanReturnStringValue()
    {
        $string = strHelpersTest::incrementBy('bar');
        $this->assertIsString($string);
    }

    public function testIncrementByCanReturnGivenStringIfDoesNotEndingWithNumbers()
    {
        $string = strHelpersTest::incrementBy('bar');
        $this->assertEquals('bar', $string);
    }

    public function testIncrementByCanIncrementGivenString()
    {
        $string = strHelpersTest::incrementBy('bar0', '*');
        $this->assertEquals('bar*1', $string);
    }

    public function testDecrementByCanReturnStringValue()
    {
        $string = strHelpersTest::decrementBy('bar');
        $this->assertIsString($string);
    }

    public function testDecrementByCanDecrementGivenString()
    {
        $string = strHelpersTest::decrementBy('bar1', '*');
        $this->assertEquals('bar*0', $string);
    }
}
