<?php

declare(strict_types=1);

namespace Jekk0\Laravel\Iso3166\Validation\Rules\Tests;

use Jekk0\Laravel\Iso3166\Validation\Rules\Iso3166Alpha3;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

final class Iso3166Alpha3Test extends TestCase
{
    private readonly Iso3166Alpha3 $rule;

    protected function setUp(): void
    {
        $this->rule = new Iso3166Alpha3();
    }

    #[DataProvider('passesSuccessDataProvider')]
    public function testPassesSuccess(string $countryCode): void
    {
        self::assertTrue($this->rule->passes('attr', $countryCode));
    }

    public static function passesSuccessDataProvider(): array
    {
        $data = str_getcsv(file_get_contents(__DIR__ . '/resources/alpha3-test.csv'));

        return [$data];
    }

    public function testPassesInvalidStringLength(): void
    {
        self::assertFalse($this->rule->passes('attr', 'AAAA'));
    }

    #[DataProvider('passesInvalidCountryCodesDataProvider')]
    public function testPassesInvalidCountryCodes(string $invalidCountryCode): void
    {
        self::assertFalse($this->rule->passes('attr', $invalidCountryCode));
    }

    public static function passesInvalidCountryCodesDataProvider(): array
    {
        return [['xxx'], ['XXX'], ['yyy'], ['YYY'],];
    }

    public function testSetErrorMessage(): void
    {
        $result = $this->rule->setErrorMessage('error');
        self::assertInstanceOf(Iso3166Alpha3::class, $result);
    }

    public function testMessage(): void
    {
        $newErrorMessage = 'Oops, form error. Parameter :attribute, Value: :input';
        $this->rule->setErrorMessage($newErrorMessage);
        self::assertEquals($this->rule->message(), $newErrorMessage);
    }
}
