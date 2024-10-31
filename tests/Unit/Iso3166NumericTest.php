<?php

declare(strict_types=1);

namespace Jekk0\Laravel\Iso3166\Validation\Rules\Tests;

use Jekk0\Laravel\Iso3166\Validation\Rules\Iso3166Numeric;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use Stub\CallableOnFail;

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

    public static function validateSuccessDataProvider(): array
    {
        $data = str_getcsv(file_get_contents(__DIR__ . '/resources/numeric-test.csv'));
        $data = array_map(intval(...), $data);

        return [$data];
    }

    #[DataProvider('validateInvalidCountryCodesDataProvider')]
    public function testValidateInvalidCountryCodes($invalidCountryCode): void
    {
        $closure = $this->createMock(CallableOnFail::class);
        $closure->expects($this->once())->method('__invoke');

        $rule = new Iso3166Numeric();
        $rule->validate('attr', $invalidCountryCode, $closure(...));
    }

    public static function validateInvalidCountryCodesDataProvider(): array
    {
        return [[1], [2], [3], [1000], [1001],];
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
}
