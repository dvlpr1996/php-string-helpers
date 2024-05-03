<?php

declare(strict_types=1);

namespace PhpStringHelpers\Tests;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use PhpStringHelpers\utility\StrUtility;
use PhpStringHelpers\exceptions\UrlIsNotValidException;
use PhpStringHelpers\exceptions\FileDoesNotExistsException;
use PhpStringHelpers\exceptions\LanguageFileIsNotArrayException;

/**
 * @covers StrUtility
 */
final class StrUtilityTest extends TestCase
{
    public StrUtility $StrUtility;
    public $basePath = __DIR__ . '/../';
    public $sampleText = 'somE TexT 444 for? tE34st! @#56$%^ <>';

    protected function setUp(): void
    {
        $this->StrUtility = new StrUtility;
    }

    public function testToCamelCaseCanReturnsStringLikeCamelCase(): void
    {
        $string = $this->StrUtility->toCamelCase($this->sampleText);

        $this->assertIsString($string);
        $this->assertEquals('someText444ForTe34st56', $string);
    }

    public function testToPascalCaseCanReturnsStringLikePascalCase(): void
    {
        $string = $this->StrUtility->toPascalCase($this->sampleText);

        $this->assertIsString($string);
        $this->assertEquals('SomeText444ForTe34st56', $string);
    }

    public function testToKebabCaseCanReturnsStringLikeKebabCase()
    {
        $string = $this->StrUtility->toKebabCase($this->sampleText);

        $this->assertIsString($string);
        $this->assertEquals('some-text-444-for-te34st-56', $string);
    }

    public function testToTitleCaseCanReturnsStringLikeTitleCase()
    {
        $string = $this->StrUtility->toTitleCase($this->sampleText);

        $this->assertIsString($string);
        $this->assertEquals('Some Text 444 For Te34st 56', $string);
    }

    public function testToConstantCanReturnStringLikeConstantCase()
    {
        $string = $this->StrUtility->toConstant($this->sampleText);

        $this->assertIsString($string);
        $this->assertEquals('SOME_TEXT_444_FOR_TE34ST_56', $string);
    }

    public function testToSnakeCaseCanReturnStringLikeSnakeCase()
    {
        $string = $this->StrUtility->toSnakeCase($this->sampleText);

        $this->assertIsString($string);
        $this->assertEquals('some_text_444_for_te34st_56', $string);
    }

    public function testToPathCaseCanReturnStringLikePathCase()
    {
        $string = $this->StrUtility->toPathCase($this->sampleText);

        $this->assertIsString($string);
        $this->assertEquals('some/text/444/for/te34st/56', $string);
    }

    public function testToAdaCaseCanReturnStringLikeAdaCase()
    {
        $string = $this->StrUtility->toAdaCase($this->sampleText);

        $this->assertIsString($string);
        $this->assertEquals('Some_Text_444_For_Te34st_56', $string);
    }

    public function testDotNotationCanReturnStringLikeDotNotation()
    {
        $string = $this->StrUtility->dotNotation($this->sampleText);

        $this->assertIsString($string);
        $this->assertEquals('somE.TexT.444.for.tE34st.56', $string);
    }

    public function testEntitiesWrapperCanReturnEmptyStringIfGivenDataIsNull()
    {
        $string = $this->StrUtility->entitiesWrapper(null);

        $this->assertIsString($string);
        $this->assertEquals('', $string);
    }

    public function testToSlugCanReturnStringLikeRegularSlug()
    {
        $string = $this->StrUtility->toSlug($this->sampleText);

        $this->assertIsString($string);
        $this->assertEquals('some-text-444-for-te34st-56', $string);
        $this->assertMatchesRegularExpression('/^[a-z0-9]+(?:-[a-z0-9]+)*$/im', $string);
    }

    public function testClearStringCanReturnSafeString(): void
    {
        $string = 'Some$ te%st @teXt l!k# 456 @#$ !-_.*+={[( <script> alert("aleRt TeXt")</script>';
        $clearStringResults = $this->StrUtility->clearString($string);

        $this->assertIsString($string);
        $this->assertMatchesRegularExpression('/[\w\d]+/', $clearStringResults);
    }

    public function testRmAllBlanksCanRemoveAllBlanksFromString()
    {
        $string = $this->StrUtility->rmAllBlanks($this->sampleText);

        $this->assertIsString($string);
        $this->assertNotSame($this->sampleText, $string);
        $this->assertMatchesRegularExpression('/[^\s]/', $string);
    }

    public function testAlternateCanReturnStringValueIfBothParamsSet()
    {
        $string = $this->StrUtility->alternate('lorem ipsum', 'dolor site');
        $this->assertIsString($string);
    }

    public function testAlternateCanReturnStringValueIfStringParamIsNull()
    {
        $string = $this->StrUtility->alternate(null, 'dolor site');
        $this->assertIsString($string);
    }

    public function testAlternateCanReturnStringValueIfAlternateParamIsNull()
    {
        $string = $this->StrUtility->alternate('lorem ipsum', null);
        $this->assertIsString($string);
    }

    public function testAlternateCanReturnStringValueIfBothParamAreNull()
    {
        $string = $this->StrUtility->alternate(null, null);

        $this->assertIsString($string);
        $this->assertEquals('not defined', $string);
    }

    public function testTranslateCanReturnStringValue()
    {
        $translatePath = $this->StrUtility->translatePath(realpath($this->basePath), 'en');
        $string = $this->StrUtility->translate($translatePath . 'app.title');
        $this->assertIsString($string);
    }

    public function testTranslateCanThrowExceptionIfLangFileDoesNotExists()
    {
        $this->expectException(FileDoesNotExistsException::class);

        $translatePath = $this->StrUtility->translatePath(realpath($this->basePath), 'en');
        $this->StrUtility->translate($translatePath . 'validation.first_name');
    }

    public function testTranslateCanThrowExceptionIfLangFileDoesNotInArrayType()
    {
        $this->expectException(LanguageFileIsNotArrayException::class);

        $translatePath = $this->StrUtility->translatePath(realpath($this->basePath), 'en');
        $this->StrUtility->translate($translatePath . 'auth.title');
    }

    public function testTranslateCanReturnReplaceParamIfGivenKeyDoesNotExists()
    {
        $translatePath = $this->StrUtility->translatePath(realpath($this->basePath), 'en');
        $string = $this->StrUtility->translate($translatePath . 'app.site', 'replace text');
        $this->assertEquals('replace text', $string);
    }

    public function testFilePathReturnedFilePathIfExists()
    {
        $basePath = realpath($this->basePath);
        $filePath = $this->StrUtility->filePath($basePath . '.lang.en.app');

        $this->assertIsString($filePath);
        $this->assertFileExists($filePath);
        $this->assertFileEquals('lang/en/app.php', $filePath);
        $this->assertFileIsReadable($filePath);
    }

    public function testPathThrowAnExceptionsIfFileDoesNotExists()
    {
        $this->expectException(FileDoesNotExistsException::class);

        $this->StrUtility->filePath('lang.en.config.auth');
    }

    public function testWrapperCanReturnStringValue()
    {
        $string = $this->StrUtility->wrapper("foo bar", "*");
        $this->assertIsString($string);
    }

    public function testWrapperCanReturnStringValueIfStringParamIsInt()
    {
        $string = $this->StrUtility->wrapper(123456, "*");
        $this->assertIsString($string);
    }

    public function testWrapperCanWrappingStringParam()
    {
        $string = $this->StrUtility->wrapper('foo', "*-*");
        $this->assertEquals('*-*foo*-*', $string);
    }

    public function testGeneratePinCanReturnsIntegerValue()
    {
        $pin = $this->StrUtility->generatePin();
        $this->assertIsInt($pin);
    }

    public function testGeneratePinLengthParamIsGreaterThanFour()
    {
        $length = 4;
        $this->StrUtility->generatePin($length);
        $this->assertGreaterThanOrEqual(4, $length);
    }

    public function testGeneratePinLengthParamIsLessThanTwelve()
    {
        $length = 12;
        $this->StrUtility->generatePin($length);
        $this->assertLessThanOrEqual(12, $length);
    }

    public function testGeneratePinReturnZeroIfLengthParamIsNotInRange()
    {
        $pin = $this->StrUtility->generatePin(24);
        $this->assertEquals(0, $pin);
    }

    public function testRandomCharCanReturnStringValue()
    {
        $string = $this->StrUtility->randomChar();
        $this->assertIsString($string);
    }

    public function testRandomHexCanReturnStringValue()
    {
        $string = $this->StrUtility->randomHex();
        $this->assertIsString($string);
    }

    public function testRandomHexReturnValueStartsWithPoundSign()
    {
        $string = $this->StrUtility->randomHex();
        $this->assertStringStartsWith('#', $string);
    }

    public function testRandomHexReturnValueIsValidHex()
    {
        $string = $this->StrUtility->randomHex();

        $this->assertEquals(7, strlen($string));
        $this->assertMatchesRegularExpression('/^[0-9ABCDEFabcdef#]+$/i', $string);
    }

    public function testRandomRgbCanReturnStringValue()
    {
        $string = $this->StrUtility->randomRgb();
        $this->assertIsString($string);
    }

    public function testRandomRgbReturnValueIsValidRgb()
    {
        $string = $this->StrUtility->randomRgb();
        $this->assertMatchesRegularExpression('/^[0-9.]+$/i', $string);
    }

    public function testRmLinkCanReturnStringValue()
    {
        $string = $this->StrUtility->rmLink('lorem www.github.com ipsum site');
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
            $string = $this->StrUtility->rmLink($input);
            $this->assertEquals('lorem ipsum site', $string);
        }
    }

    public function testLimitCharCanReturnStringValue()
    {
        $string = $this->StrUtility->limitChar('foo bar', 5);
        $this->assertIsString($string);
    }

    public function testLimitCharCanLimitGivenString()
    {
        $string = $this->StrUtility->limitChar('foo bar', 2);
        $this->assertEquals('foo b...', $string);
    }

    public function testLimitCharCanReturnGivenStringIfLengthParamIsBiggerThanStringLength()
    {
        $string = $this->StrUtility->limitChar('foo bar', 8);
        $this->assertEquals('foo bar', $string);
    }

    public function testGenerateIdCanReturnStringValue()
    {
        $string = $this->StrUtility->generateId();

        $this->assertIsString($string);
        $this->assertMatchesRegularExpression('/^[0-9a-zA-Z-]+/i', $string);
    }

    public function testRmNumbersCanReturnStringValue()
    {
        $string = $this->StrUtility->rmNumbers($this->sampleText);

        $this->assertIsString($string);
        $this->assertMatchesRegularExpression('/^[\w\W]+$/i', $string);
    }

    public function testRmNumbersReturnEmptyStringIfGivenNumericStringParam()
    {
        $string = $this->StrUtility->rmNumbers("0123456789");
        $this->assertEquals('', $string);
    }

    public function testRmCharactersCanReturnStringValue()
    {
        $string = $this->StrUtility->rmCharacters($this->sampleText);

        $this->assertIsString($string);
        $this->assertMatchesRegularExpression('/[-_a-zA-Z\W]+/i', $string);
    }

    public function testRmCharactersReturnEmptyStringIfGivenEmptyStringParam()
    {
        $string = $this->StrUtility->rmCharacters('');
        $this->assertEquals('', $string);
    }

    public function testRmExtraBlankCanReturnStringValue()
    {
        $string = $this->StrUtility->rmExtraBlank($this->sampleText);
        $this->assertIsString($string);
    }

    public function testRmExtraBlankReturnEmptyStringIfGivenEmptyStringParam()
    {
        $string = $this->StrUtility->rmExtraBlank('');
        $this->assertEquals('', $string);
    }

    public function testHexToRgbCanReturnStringValueIfColorParamIsValid()
    {
        $color = $this->StrUtility->hexToRgb('#bada55');
        $this->assertIsString($color);
    }

    public function testHexToRgbCanReturnNullValueIfColorParamIsNotValid()
    {
        $color = $this->StrUtility->hexToRgb('#bada4r');
        $this->assertNull($color);
    }

    public function testHexToRgbCanReturnValidRgbColor()
    {
        $color = $this->StrUtility->hexToRgb('#bada44');
        $this->assertMatchesRegularExpression('/^[0-9.]+$/i', $color);
    }

    public function testRgbToHexCanReturnStringValueIfColorParamIsValid()
    {
        $color = $this->StrUtility->rgbToHex('250.230.100');
        $this->assertIsString($color);
    }

    public function testRgbToHexCanReturnNullValueIfColorParamIsNotValid()
    {
        $color = $this->StrUtility->rgbToHex('25a.23b.100');
        $this->assertNull($color);
    }

    public function testRgbToHexCanReturnValidHexColor()
    {
        $color = $this->StrUtility->rgbToHex('250.230.100');

        $this->assertEquals(7, strlen($color));
        $this->assertMatchesRegularExpression('/^[0-9ABCDEFabcdef#]+$/i', $color);
        $this->assertStringStartsWith('#', $color);
    }

    public function testGenerateAnchorCanReturnStringValue()
    {
        $anchorText = $this->StrUtility->generateAnchor('example link', 'https://github.com/');
        $this->assertIsString($anchorText);
    }

    public function testGenerateAnchorCanThrowExceptionIfHrefParamIsNotValid()
    {
        $this->expectException(UrlIsNotValidException::class);
        $this->StrUtility->generateAnchor('example link', '12github.#$co');
    }

    public function testGetEncodingCanReturnStringValue()
    {
        $string = $this->StrUtility->getEncoding('foo bar baz');
        $this->assertIsString($string);
    }

    public function testIsUtf8CanReturnTrueWhenGivenUtf8Encoding()
    {
        $string = $this->StrUtility->isUtf8('foo bar baz');

        $this->assertIsBool($string);
        $this->assertTrue($string);
    }

    public function testRmDuplicateWordsCanReturnStringValue()
    {
        $string = "lorem ipsum dolor site amet loreM SITE";
        $string = $this->StrUtility->rmDuplicateWords($string);
        $this->assertIsString($string);
    }

    public function testRmRightCharCanReturnWordsParamIfNumParamIsGreaterThanWordsParamLength()
    {
        $testString = 'foo bar';
        $stringLength = strlen($testString);
        $num = $stringLength + 5;
        $string = $this->StrUtility->rmRightChar($testString, $num);

        $this->assertIsString($string);
        $this->assertEquals($testString, $string);
    }

    public function testRmRightCharCanRemoveCharacterFromRightSideOfStringBaseOnNumParam()
    {
        $num = 2;
        $string = 'foo bar';
        $stringLength = strlen($string);
        $string = $this->StrUtility->rmRightChar($string, $num);

        $this->assertEquals($stringLength - $num, strlen($string));
        $this->assertStringEndsWith($string, 'foo b');
    }

    public function testRmLeftCharCanRemoveCharacterFromLeftSideOfStringBaseOnNumParam()
    {
        $num = 2;
        $string = 'foo bar';
        $stringLength = strlen($string);
        $string = $this->StrUtility->rmLeftChar($string, $num);

        $this->assertIsString($string);
        $this->assertEquals($stringLength - $num, strlen($string));
        $this->assertStringStartsWith($string, 'o bar');
    }

    public function testRmLeftCharCanReturnWordsParamIfNumParamIsGreaterThanWordsParamLength()
    {
        $testString = 'foo bar';
        $stringLength = strlen($testString);
        $num = $stringLength + 5;
        $string = $this->StrUtility->rmLeftChar($testString, $num);

        $this->assertEquals($testString, $string);
    }

    public function testRmBothSideCharCanRemoveCharacterFromBothSideOfStringBaseOnNumParam()
    {
        $num = 2;
        $string = 'foo bar';
        $stringLength = strlen($string);
        $string = $this->StrUtility->rmBothSideChar($string, $num);

        $this->assertIsString($string);
        $this->assertEquals($stringLength - $num * 2, strlen($string));
        $this->assertStringStartsWith($string, 'o b');
    }

    public function testIsJsonCanReturnBoolValue()
    {
        $result = $this->StrUtility->isJson('{"name":"john"}');
        $this->assertIsBool($result);
    }

    public function testIsJsonCanReturnFalseIfGivenDataIsNotAJsonType()
    {
        $result = $this->StrUtility->isJson('["name"=>"john"]');
        $this->assertTrue(!$result);
    }

    public function testIsJsonCanReturnsFalseIfGivenDataIsEmpty()
    {
        $result = $this->StrUtility->isJson([]);
        $this->assertTrue(!$result);
    }

    public function testIsJsonCanReturnsFalseIfGivenDataIsString()
    {
        $result = $this->StrUtility->isJson('foo');
        $this->assertTrue(!$result);
    }

    public function testPureStringCanReturnOnlyString()
    {
        $string = $this->StrUtility->pureString($this->sampleText);

        $this->assertIsString($string);
        $this->assertMatchesRegularExpression('/[A-Za-z]+$/i', $string);
    }

    public function testIsContainsCanReturnTrueIfSearchParamIsExistsInGivenStringParam()
    {
        $string = $this->StrUtility->isContains('foo bar', 'foo');
        $this->assertTrue($string);
    }

    public function testIsContainsCanReturnFalseIfSearchParamIsNotExistsInGivenStringParam()
    {
        $string = $this->StrUtility->isContains('foo bar', 'baz');
        $this->assertTrue(!$string);
    }

    public function testIsContainsCanReturnBooleanValueInCaseSensitiveIsTrue()
    {
        $string = $this->StrUtility->isContains('foo bar', 'Foo', true);
        $this->assertIsBool($string);
    }

    public function testIsContainsCanReturnTrueIfSearchParamIsExistsInGivenStringParamInCaseSensitiveIsTrue()
    {
        $string = $this->StrUtility->isContains('FOo bar', 'FOo', true);
        $this->assertTrue($string);
    }

    public function testIsContainsCanReturnFalseIfSearchParamIsNotExistsInGivenStringParamInCaseSensitiveIsTrue()
    {
        $string = $this->StrUtility->isContains('foo bar', 'baz', true);
        $this->assertTrue(!$string);
    }

    public function testIsContainsCanReturnFalseSearchOrStringParamsAreEmpty()
    {
        $string = $this->StrUtility->isContains('foo bar', '');
        $this->assertTrue(!$string);
    }

    public function testIsStartWithCanReturnBooValue()
    {
        $string = $this->StrUtility->isStartWith('foo', 'f');
        $this->assertIsBool($string);
    }

    public function testIsStartWithCanReturnTrueIfGivenStringStartWithSearchParam()
    {
        $string = $this->StrUtility->isStartWith('foo', 'f');
        $this->assertTrue($string);
    }

    public function testIsStartWithCanReturnFalseIfStringOrSearchParamIsEmpty()
    {
        $string = $this->StrUtility->isStartWith('', '');
        $this->assertTrue(!$string);
    }

    public function testLastWordCanReturnStringValue()
    {
        $lastWord = $this->StrUtility->lastWord('foo bar baz');
        $this->assertIsString($lastWord);
    }

    public function testLastWordCanReturnLastWordOfGivenString()
    {
        $lastWord = $this->StrUtility->lastWord('baz');
        $this->assertStringEndsWith('baz', $lastWord);
    }

    public function testLastWordCanReturnEmptyStringInGivenEmptyString()
    {
        $lastWord = $this->StrUtility->lastWord('');
        $this->assertEquals('', $lastWord);
    }

    public function testFirstWordCanReturnFirstWordOfGivenString()
    {
        $firstWord = $this->StrUtility->firstWord('foo bar baz');

        $this->assertIsString($firstWord);
        $this->assertStringEndsWith('foo', $firstWord);
    }

    public function testFirstWordCanReturnEmptyStringInGivenEmptyString()
    {
        $firstWord = $this->StrUtility->firstWord('');
        $this->assertEquals('', $firstWord);
    }

    public function testGetFirstNumbersCanReturnEmptyStringIfGivenStringParamDoesNotStartWithNumber()
    {
        $firstNumber = $this->StrUtility->getFirstNumbers('bar5 2foo 3baz');

        $this->assertIsString($firstNumber);
        $this->assertEquals('', $firstNumber);
    }

    public function testGetLastNumbersCanReturnEmptyStringIfGivenStringParamDoesNotEndingWithNumber()
    {
        $lastNumber = $this->StrUtility->getLastNumbers('bar5 2foo 3baz');

        $this->assertIsString($lastNumber);
        $this->assertEquals('', $lastNumber);
    }

    public function testGetLastNumbersCanReturnEmptyStringIfGivenStringParamIsEmpty()
    {
        $lastNumber = $this->StrUtility->getLastNumbers('');
        $this->assertEquals('', $lastNumber);
    }

    public function testRmBeginningNumbersCanRemoveNumbersFromTheBeginningOfWords()
    {
        $string = $this->StrUtility->rmBeginningNumbers('5foo 66b5ar88 555 321b1az321');

        $this->assertIsString($string);
        $this->assertEquals('foo b5ar88 b1az321', $string);
    }

    public function testRmEndingNumbersCanRemoveNumbersFromEndingOfWords()
    {
        $string = $this->StrUtility->rmEndingNumbers('5foo 66b5ar55 555 321b1az321');

        $this->assertIsString($string);
        $this->assertEquals('5foo 66b5ar 321b1az', $string);
    }

    public function testConvertToUtf8CanReturnStringValue()
    {
        $string = $this->StrUtility->convertToUtf8('bar foo baz');
        $this->assertIsString($string);
    }

    public function testConvertToUtf8CanReturnFalseValueIfCanNotConvert()
    {
        $string = $this->StrUtility->convertToUtf8('');
        $this->assertTrue(!$string);
    }

    public function testIncrementByCanReturnGivenStringIfDoesNotEndingWithNumbers()
    {
        $string = $this->StrUtility->incrementBy('bar');

        $this->assertIsString($string);
        $this->assertEquals('bar', $string);
    }

    public function testIncrementByCanIncrementGivenString()
    {
        $string = $this->StrUtility->incrementBy('bar0', '*');
        $this->assertEquals('bar*1', $string);
    }

    public function testDecrementByCanReturnStringValue()
    {
        $string = $this->StrUtility->decrementBy('bar');
        $this->assertIsString($string);
    }

    public function testDecrementByCanDecrementGivenString()
    {
        $string = $this->StrUtility->decrementBy('bar1', '*');
        $this->assertEquals('bar*0', $string);
    }

    public function testRmLastWordCanRemoveLastWordOfGivenString()
    {
        $string = $this->StrUtility->rmLastWord('foo bar baz 123');

        $this->assertIsString($string);
        $this->assertEquals('foo bar baz', $string);
    }

    public function testRmFirstWordCanRemoveFirstWordOfGivenString()
    {
        $string = $this->StrUtility->rmFirstWord('12 123 foo bar baz');

        $this->assertIsString($string);
        $this->assertEquals('123 foo bar baz', $string);
    }

    public function testIsSlugCanReturnBooleanValue()
    {
        $slug = $this->StrUtility->is_slug('foo-bar-baz');
        $this->assertIsBool($slug);
    }

    public function testIsSlugReturnFalseIfGivenStringIsNotASlug()
    {
        $slug = $this->StrUtility->is_slug('foo bar baz');
        $this->assertNotTrue($slug);
    }

    public function testIsSlugReturnTrueIfGivenStringIsASlug()
    {
        $slug = $this->StrUtility->is_slug('132Foo-12bar-3432az');
        $this->assertTrue($slug);
    }

    public function testIsIpV4CanReturnBooleanValue()
    {
        $ip = $this->StrUtility->is_ipv4('127.0.0.1');
        $this->assertIsBool($ip);
    }

    public function testIsIpV4CanReturnFalseIfGivenIp4IsNotValid()
    {
        $ip = $this->StrUtility->is_ipv4('127.0.0.256');
        $this->assertFalse($ip);
    }

    public function testIsIpV4CanReturnTrueIfGivenIp4IsValid()
    {
        $ip = $this->StrUtility->is_ipv4('127.0.0.255');
        $this->assertTrue($ip);
    }

    public function testIsIpV4CanReturnFalseIfGivenIpParamIsEmpty()
    {
        $ip = $this->StrUtility->is_ipv4('');
        $this->assertFalse($ip);
    }

    public function testIsIpV4CanReturnFalseIfGivenIpParamIsNotString()
    {
        $ip = $this->StrUtility->is_ipv4('foo bar');
        $this->assertFalse($ip);
    }

    public function testIsIpV6CanReturnBooleanValue()
    {
        $ip = $this->StrUtility->is_ipv6('2001:0db8:0000:0000:0000:ff00:0042:8329');
        $this->assertIsBool($ip);
    }

    public function testIsIpV6CanReturnFalseIfGivenIp6IsNotValid()
    {
        $ip = $this->StrUtility->is_ipv6('127.0.0.1');
        $this->assertFalse($ip);
    }

    public function testIsIpV6CanReturnTrueIfGivenIp6IsValid()
    {
        $ip = $this->StrUtility->is_ipv6('2001:0db8:0000:0000:0000:ff00:0042:8329');
        $this->assertTrue($ip);
    }

    public function testIsIpV6CanReturnFalseIfGivenIpParamIsEmpty()
    {
        $ip = $this->StrUtility->is_ipv6('');
        $this->assertFalse($ip);
    }

    public function testIsIpV6CanReturnFalseIfGivenIpParamIsNotString()
    {
        $ip = $this->StrUtility->is_ipv6('foo bar baz');
        $this->assertFalse($ip);
    }

    public function testAfterCanReturnStringValue()
    {
        $string = $this->StrUtility->after('foo bar baz', 'bar');
        $this->assertIsString($string);
    }

    public function testAfterCanReturnStringParamIfStringParamIsEmpty()
    {
        $string = $this->StrUtility->after('', 'foo');
        $this->assertEquals('', $string);
    }

    public function testAfterCanReturnStringParamIfSearchIsEmpty()
    {
        $string = $this->StrUtility->after('foo bar baz', '');
        $this->assertEquals('foo bar baz', $string);
    }

    public function testAfterCanRemoveTheWordsBeforeTheSearchParam()
    {
        $string = $this->StrUtility->after('foo bar baz', 'bar');
        $this->assertEquals('baz', $string);
    }

    public function testBeforeCanReturnStringValue()
    {
        $string = $this->StrUtility->before('foo bar baz', 'bar');
        $this->assertIsString($string);
    }

    public function testBeforeCanReturnStringParamIfStringParamIsEmpty()
    {
        $string = $this->StrUtility->before('', 'foo');
        $this->assertEquals('', $string);
    }

    public function testBeforeCanReturnStringParamIfSearchIsEmpty()
    {
        $string = $this->StrUtility->before('foo bar baz', '');
        $this->assertEquals('foo bar baz', $string);
    }

    public function testBeforeCanRemoveTheWordsAfterTheSearchParam()
    {
        $string = $this->StrUtility->before('foo bar baz', 'foo');
        $this->assertEquals('', $string);
    }

    public function testHasSpaceCanReturnTrueValue()
    {
        $string = $this->StrUtility->hasSpace('foo bar baz');
        $this->assertTrue($string);
    }

    public function testHasSpaceCanReturnFalseValue()
    {
        $string = $this->StrUtility->hasSpace('foo');
        $this->assertFalse($string);
    }

    public function testIsEmailCanReturnTrueValue()
    {
        $emails = [
            'johndoe@gmail.com',
            'john_doe@gmail.com',
            'john34doe@gmail.com',
            '14324@gmail.com',
            'example@gmail.com',
            'example@5646.com',
            'johndoe@example.com',
        ];

        foreach ($emails as $email) {
            $email = $this->StrUtility->isEmail($email);
            $this->assertTrue($email);
        }
    }

    public function testIsEmailCanReturnFalseValueIfAddressIsNotValid()
    {
        $emails = [
            '§john@gmail.com',
            'john_doe§@gmail.com',
            'john34doe.com.@gmail.com',
            '14324@com',
            'example#gmail.com',
            '«@5646.com',
            'johndoe@example.«',
        ];

        foreach ($emails as $email) {
            $email = $this->StrUtility->isEmail($email);
            $this->assertFalse($email);
        }
    }

    public function testDetectLowerCaseMethodCanReturnLowercase(): void
    {
        $this->assertEquals('lowerCase', $this->StrUtility->detectCase('lowercase'));
    }

    public function testDetectUpperCaseMethodCanReturnUppercase(): void
    {
        $this->assertEquals('upperCase', $this->StrUtility->detectCase('UPPERCASE'));
    }

    public function testDetectTitleCaseMethodCanReturnTitleCase(): void
    {
        $words = [
            'Title Case',
            'Title Case Again',
            'Title Case Again Ti Tle Case',
        ];

        foreach ($words as $word) {
            $this->assertEquals('titleCase', $this->StrUtility->detectCase($word));
        }
    }

    public function testDetectSnakeCaseMethodCanReturnSnakeCase(): void
    {
        $words = [
            'snake_case',
            'snake_case_lorem',
        ];

        foreach ($words as $word) {
            $this->assertEquals('snakeCase', $this->StrUtility->detectCase($word));
        }
    }

    public function testDetectMixedCase(): void
    {
        $this->assertEquals('mixedCase', $this->StrUtility->detectCase('MixedCase'));
    }

    public function testIsLowerCaseCanReturnTheTrueValueIfGivenWordIsLowerCase()
    {
        $words = [
            'loremipsum',
            'foobarbaz',
        ];

        foreach ($words as $word) {
            $this->assertTrue($this->StrUtility->islowerCase($word));
        }
    }

    public function testIsLowerCaseCanReturnTheFalseValueIfGivenWordIsNotLowerCase()
    {
        $words = [
            'lorem ipsuM',
            'foo Barbaz66',
            '66 fOo bar',
            'bazBbar',
            'baz-Bbar',
            'baz_Bbar',
        ];

        foreach ($words as $word) {
            $this->assertFalse($this->StrUtility->islowerCase($word));
        }
    }

    public function testIsUpperCaseCanReturnTheTrueValueIfGivenWordIsUpperCase()
    {
        $words = [
            'LOREMIPSUM',
            'FOOBARBAZ',
        ];

        foreach ($words as $word) {
            $this->assertTrue($this->StrUtility->isUpperCase($word));
        }
    }

    public function testIsUpperCaseCanReturnTheFalseValueIfGivenStringIsNotUpperCase()
    {
        $words = [
            'LoremipsuM',
            'FoOBarbaz66',
            '66fOobaR',
            'bazBbar',
            'baz-Bbar',
            'baz_Bbar',
        ];

        foreach ($words as $word) {
            $this->assertFalse($this->StrUtility->isUpperCase($word));
        }
    }

    public function testIsTitleCaseCanReturnTheTrueValueIfGivenWordIsTitleCase()
    {
        $words = [
            'Loremipsum',
            'Foobarbaz',
        ];

        foreach ($words as $word) {
            $this->assertTrue($this->StrUtility->isTitleCase($word));
        }
    }

    public function testIsTitleCaseCanReturnTheFalseValueIfGivenWordIsNotTitleCase()
    {
        $words = [
            'aoremipsum',
            'foobarbaz',
        ];

        foreach ($words as $word) {
            $this->assertFalse($this->StrUtility->isTitleCase($word));
        }
    }

    public function testIsSnakeCaseCanReturnTheTrueValueIfGivenWordIsSnakeCase()
    {
        $words = [
            'lorem_ipsum',
            'foo_bar_baz',
        ];

        foreach ($words as $word) {
            $this->assertTrue($this->StrUtility->isSnakeCase($word));
        }
    }

    public function testIsSnakeCaseCanReturnTheFalseValueIfGivenWordIsNotSnakeCase()
    {
        $words = [
            'UPPERCASE',
            'Lorem-ipsum',
            'lorem-ipsum',
            '347865783',
        ];

        foreach ($words as $word) {
            $this->assertFalse($this->StrUtility->isSnakeCase($word));
        }
    }

    public function testValidateUserNameCanReturnTrueIfGivenUserNameIsValid()
    {
        $userNames = [
            'jonhDoe',
            '__jonhDoe',
            '_-jonh-Doe66_',
            '__jonh-Doe66__',
            'jonh_Doe___-.',
            'jonh__Doe',
            'jonh_Doe',
            'jonhDoe_66',
            '.-jonh_Doe_66',
            'jonh_Doe_66',
            'jonh_Doe-66-Foo_B_',
            '_.john._66',
        ];

        foreach ($userNames as $userName) {
            $userName = $this->StrUtility->validateUserName($userName);
            $this->assertTrue($userName);
        }
    }

    public function testValidateUserNameCanReturnFalseIfGivenUserNameIsNotValid()
    {
        $userNames = [
            'jonhDoe_______________98',
            '__jonhDoe__@',
            '!@_-jonh-Doe66_',
            '__jon@h-Doe66__',
            'jonh_Doe___-.!',
            'jqw$..onh__Doe',
        ];

        foreach ($userNames as $userName) {
            $userName = $this->StrUtility->validateUserName($userName);
            $this->assertFalse($userName);
        }
    }

    public function testHumanFileSizeCanConvertBytesToKB()
    {
        $this->assertEquals('1.00 KB', $this->StrUtility->humanFileSize(1024, 'KB'));
    }

    public function testHumanFileSizeCanConvertBytesToMB()
    {
        $this->assertEquals('1.00 MB', $this->StrUtility->humanFileSize(1024 * 1024, 'MB'));
    }

    public function testHumanFileSizeCanConvertBytesToGB()
    {
        $this->assertEquals('1.00 GB', $this->StrUtility->humanFileSize(1024 * 1024 * 1024, 'GB'));
    }

    public function testHumanFileSizeCanConvertBytesToTB()
    {
        $this->assertEquals('1.00 TB', $this->StrUtility->humanFileSize(1024 * 1024 * 1024 * 1024, 'TB'));
    }

    public function testHumanFileSizeCanInvalidTypeThrowsException()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->StrUtility->humanFileSize(1024, 'XYZ');
    }

    public function testNegativeSizeThrowsException()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->StrUtility->humanFileSize(-1024, 'KB');
    }
}
