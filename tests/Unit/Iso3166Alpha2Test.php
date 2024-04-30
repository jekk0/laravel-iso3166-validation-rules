<?php

declare(strict_types=1);

namespace Jekk0\Laravel\Iso3166\Validation\Rules\Tests;

use Jekk0\Laravel\Iso3166\Validation\Rules\Iso3166Alpha2;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\DataProvider;

final class Iso3166Alpha2Test extends TestCase
{
    private readonly Iso3166Alpha2 $rule;

    protected function setUp(): void
    {
        $this->rule = new Iso3166Alpha2();
    }

    #[DataProvider('passesSuccessDataProvider')]
    public function testPassesSuccess(string $countryCode): void
    {
        self::assertTrue($this->rule->passes('attr', $countryCode));
    }

    public static function passesSuccessDataProvider(): array
    {
        $data = str_getcsv(file_get_contents(__DIR__ . '/resources/alpha2-test.csv'));

        return [$data];
    }

    public function testPassesInvalidStringLength(): void
    {
        self::assertFalse($this->rule->passes('attr', 'UUU'));
    }

    #[DataProvider('passesInvalidCountryCodesDataProvider')]
    public function testPassesInvalidCountryCodes(string $invalidCountryCode): void
    {
        self::assertFalse($this->rule->passes('attr', $invalidCountryCode));
    }

    public static function passesInvalidCountryCodesDataProvider(): array
    {
        return [['xx'], ['XX'], ['yy'], ['YY'],];
    }

    public function testSetErrorMessage(): void
    {
        $result = $this->rule->setErrorMessage('error');
        self::assertInstanceOf(Iso3166Alpha2::class, $result);
    }

    public function testMessage(): void
    {
        $newErrorMessage = 'Oops, form error. Parameter :attribute, Value: :input';
        $this->rule->setErrorMessage($newErrorMessage);
        self::assertEquals($this->rule->message(), $newErrorMessage);
    }
}
