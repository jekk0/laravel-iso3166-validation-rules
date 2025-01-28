<?php

declare(strict_types=1);

namespace Jekk0\Laravel\Iso3166\Validation\Rules\Tests\Unit;

use Jekk0\Laravel\Iso3166\Validation\Rules\Classes\CountryCodes;
use Jekk0\Laravel\Iso3166\Validation\Rules\Classes\Iso3166Validator;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

#[CoversClass(Iso3166Validator::class)]
#[CoversClass(CountryCodes::class)]
final class Iso3166ValidatorTest extends TestCase
{
    private Iso3166Validator $validator;

    protected function setUp(): void
    {
        $this->validator = new Iso3166Validator(new CountryCodes());
    }

    #[DataProvider('validNumericCountryCodeDataProvider')]
    public function testValidNumericCountryCode(int $countryCode): void
    {
        $result = $this->validator->isValidNumericCountryCode($countryCode);

        $this->assertTrue($result);
    }

    public static function validNumericCountryCodeDataProvider(): \Generator
    {
        yield from [
            [798],
            [800],
            [804],
            [784],
            [826,]
        ];
    }

    #[DataProvider('invalidNumericCountryCodeDataProvider')]
    public function testInvalidNumericCountryCode(int $countryCode): void
    {
        $result = $this->validator->isValidNumericCountryCode($countryCode);

        $this->assertFalse($result);
    }

    public static function invalidNumericCountryCodeDataProvider(): \Generator
    {
        yield from [
            [0],
            [-3],
            [9999],
            [5050],
            [-826]
        ];
    }

    #[DataProvider('validAlpha2CountryCodeDataProvider')]
    public function testValidAlpha2CountryCode(string $countryCode): void
    {
        $result = $this->validator->isValidAlpha2CountryCode($countryCode);

        $this->assertTrue($result);
    }

    public static function validAlpha2CountryCodeDataProvider(): \Generator
    {
        yield from [
            ['at'],
            ['az'],
            ['BS'],
            ['BH'],
            ['BD'],
            ['bb'],
            ['BY']
        ];
    }

    #[DataProvider('invalidAlpha2CountryCodeDataProvider')]
    public function testInvalidAlpha2CountryCode(string $countryCode): void
    {
        $result = $this->validator->isValidAlpha2CountryCode($countryCode);

        $this->assertFalse($result);
    }

    public static function invalidAlpha2CountryCodeDataProvider(): \Generator
    {
        yield from [
            [''],
            ['AZA'],
            ['xx'],
            ['YY'],
        ];
    }

    #[DataProvider('validAlpha3CountryCodeDataProvider')]
    public function testValidAlpha3CountryCode(string $countryCode): void
    {
        $result = $this->validator->isValidAlpha3CountryCode($countryCode);

        $this->assertTrue($result);
    }

    public static function validAlpha3CountryCodeDataProvider(): \Generator
    {
        yield from [
            ['svn'],
            ['LKA'],
            ['ton'],
        ];
    }

    #[DataProvider('invalidAlpha3CountryCodeDataProvider')]
    public function testInvalidAlpha3CountryCode(string $countryCode): void
    {
        $result = $this->validator->isValidAlpha3CountryCode($countryCode);

        $this->assertFalse($result);
    }

    public static function invalidAlpha3CountryCodeDataProvider(): \Generator
    {
        yield from [
            [''],
            ['aza'],
            ['XXX'],
            ['yyy'],
            ['wwww'],
        ];
    }
}
