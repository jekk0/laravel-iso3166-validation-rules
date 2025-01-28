<?php

declare(strict_types=1);

namespace Jekk0\Laravel\Iso3166\Validation\Rules\Tests\Unit;

use Jekk0\Laravel\Iso3166\Validation\Rules\Classes\Iso3166BaseRule;
use Jekk0\Laravel\Iso3166\Validation\Rules\Iso3166Numeric;
use Jekk0\Laravel\Iso3166\Validation\Rules\Tests\Stub\CallableOnFail;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

#[CoversClass(Iso3166Numeric::class)]
#[CoversClass(Iso3166BaseRule::class)]
final class Iso3166NumericTest extends TestCase
{
    #[DataProvider('validateSuccessDataProvider')]
    public function testValidateSuccess(int $countryCode): void
    {
        $closure = $this->createMock(CallableOnFail::class);
        $closure->expects($this->never())->method('__invoke');

        $rule = new Iso3166Numeric();
        $rule->validate('attr', $countryCode, $closure(...));
    }

    public static function validateSuccessDataProvider(): \Generator
    {
        $data = str_getcsv(file_get_contents(__DIR__ . '/resources/numeric-test.csv'));
        $data = array_map(intval(...), $data);

        yield from [$data];
    }

    #[DataProvider('validateInvalidCountryCodesDataProvider')]
    public function testValidateInvalidCountryCodes(int $invalidCountryCode): void
    {
        $closure = $this->createMock(CallableOnFail::class);
        $closure->expects($this->once())->method('__invoke');

        $rule = new Iso3166Numeric();
        $rule->validate('attr', $invalidCountryCode, $closure(...));
    }

    public static function validateInvalidCountryCodesDataProvider(): \Generator
    {
        yield from [[1], [2], [3], [1000], [1001],];
    }

    public function testSetErrorMessage(): void
    {
        $customErrorMessage = 'Iso3166Numeric Custom Error Message :attribute';
        $closure = $this->createMock(CallableOnFail::class);
        $closure->expects($this->once())->method('__invoke')->with($customErrorMessage);

        $rule = new Iso3166Numeric();
        $rule->setErrorMessage($customErrorMessage);
        $rule->validate('attr', 'invalid', $closure(...));
    }

    /** Regression test for bugfix, see tag 1.0.1 */
    public function testSetErrorMessageReturnRuleInstance(): void
    {
        $customErrorMessage = 'Message';
        $rule = new Iso3166Numeric();
        $ruleInstance = $rule->setErrorMessage($customErrorMessage);

        self::assertInstanceOf(Iso3166Numeric::class, $ruleInstance);
    }
}
