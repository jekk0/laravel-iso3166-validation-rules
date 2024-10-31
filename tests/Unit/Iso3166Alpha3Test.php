<?php

declare(strict_types=1);

namespace Jekk0\Laravel\Iso3166\Validation\Rules\Tests;

use Jekk0\Laravel\Iso3166\Validation\Rules\Iso3166Alpha3;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use Stub\CallableOnFail;

final class Iso3166Alpha3Test extends TestCase
{
    #[DataProvider('validateSuccessDataProvider')]
    public function testValidateSuccess(string $countryCode): void
    {
        $closure = $this->createMock(CallableOnFail::class);
        $closure->expects($this->never())->method('__invoke');

        $rule = new Iso3166Alpha3();
        $rule->validate('attr', $countryCode, $closure(...));
    }

    public static function validateSuccessDataProvider(): array
    {
        $data = str_getcsv(file_get_contents(__DIR__ . '/resources/alpha3-test.csv'));

        return [$data];
    }

    public function testValidateInvalidStringLength(): void
    {
        $closure = $this->createMock(CallableOnFail::class);
        $closure->expects($this->once())->method('__invoke');

        $rule = new Iso3166Alpha3();
        $rule->validate('attr', 'AAAA', $closure(...));
    }

    #[DataProvider('validateInvalidCountryCodesDataProvider')]
    public function testValidateInvalidCountryCodes(string $invalidCountryCode): void
    {
        $closure = $this->createMock(CallableOnFail::class);
        $closure->expects($this->once())->method('__invoke');

        $rule = new Iso3166Alpha3();
        $rule->validate('attr', $invalidCountryCode, $closure(...));
    }

    public static function validateInvalidCountryCodesDataProvider(): array
    {
        return [['xxx'], ['XXX'], ['yyy'], ['YYY'],];
    }

    public function testSetErrorMessage(): void
    {
        $customErrorMessage = 'Iso3166Alpha3 Custom Error Message :attribute';
        $closure = $this->createMock(CallableOnFail::class);
        $closure->expects($this->once())->method('__invoke')->with($customErrorMessage);

        $rule = new Iso3166Alpha3();
        $rule->setErrorMessage($customErrorMessage);
        $rule->validate('attr', 'invalid', $closure(...));
    }
}
