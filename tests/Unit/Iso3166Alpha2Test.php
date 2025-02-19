<?php

declare(strict_types=1);

namespace Jekk0\Laravel\Iso3166\Validation\Rules\Tests\Unit;

use Jekk0\Laravel\Iso3166\Validation\Rules\Classes\Iso3166BaseRule;
use Jekk0\Laravel\Iso3166\Validation\Rules\Iso3166Alpha2;
use Jekk0\Laravel\Iso3166\Validation\Rules\Tests\Stub\CallableOnFail;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

#[CoversClass(Iso3166Alpha2::class)]
#[CoversClass(Iso3166BaseRule::class)]
final class Iso3166Alpha2Test extends TestCase
{
    #[DataProvider('validateSuccessDataProvider')]
    public function testValidateSuccess(string $countryCode): void
    {
        $closure = $this->createMock(CallableOnFail::class);
        $closure->expects($this->never())->method('__invoke');

        $rule = new Iso3166Alpha2();
        $rule->validate('attr', $countryCode, $closure(...));
    }

    public static function validateSuccessDataProvider(): \Generator
    {
        $data = str_getcsv(file_get_contents(__DIR__ . '/resources/alpha2-test.csv'));

        yield from [$data];
    }

    public function testValidateInvalidStringLength(): void
    {
        $closure = $this->createMock(CallableOnFail::class);
        $closure->expects($this->once())->method('__invoke');

        $rule = new Iso3166Alpha2();
        $rule->validate('attr', 'UUU', $closure(...));
    }

    #[DataProvider('validateInvalidCountryCodesDataProvider')]
    public function testValidateInvalidCountryCodes(string $invalidCountryCode): void
    {
        $closure = $this->createMock(CallableOnFail::class);
        $closure->expects($this->once())->method('__invoke');

        $rule = new Iso3166Alpha2();
        $rule->validate('attr', $invalidCountryCode, $closure(...));
    }

    public static function validateInvalidCountryCodesDataProvider(): \Generator
    {
        yield from [['xx'], ['XX'], ['yy'], ['YY'],];
    }

    public function testValidateInvalidValueType(): void
    {
        $closure = $this->createMock(CallableOnFail::class);
        $closure->expects($this->once())->method('__invoke');

        $rule = new Iso3166Alpha2();
        $rule->validate('attr', 111, $closure(...));
    }

    public function testSetErrorMessage(): void
    {
        $customErrorMessage = 'Iso3166Alpha2 Custom Error Message :attribute';
        $closure = $this->createMock(CallableOnFail::class);
        $closure->expects($this->once())->method('__invoke')->with($customErrorMessage);

        $rule = new Iso3166Alpha2();
        $rule->setErrorMessage($customErrorMessage);
        $rule->validate('attr', 'invalid', $closure(...));
    }

    /** Regression test for bugfix, see tag 1.0.1 */
    public function testSetErrorMessageReturnRuleInstance(): void
    {
        $customErrorMessage = 'Message';
        $rule = new Iso3166Alpha2();
        $ruleInstance = $rule->setErrorMessage($customErrorMessage);

        self::assertInstanceOf(Iso3166Alpha2::class, $ruleInstance);
    }
}
