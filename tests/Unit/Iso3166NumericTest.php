<?php

declare(strict_types=1);

namespace Jekk0\Laravel\Iso3166\Validation\Rules\Tests;

use Jekk0\Laravel\Iso3166\Validation\Rules\Iso3166Numeric;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

final class Iso3166NumericTest extends TestCase
{
    private readonly Iso3166Numeric $rule;

    protected function setUp(): void
    {
        $this->rule = new Iso3166Numeric();
    }

    #[DataProvider('passesSuccessDataProvider')]
    public function testPassesSuccess(int $countryCode): void
    {
        self::assertTrue($this->rule->passes('attr', $countryCode));
    }

    public static function passesSuccessDataProvider(): array
    {
        $data = str_getcsv(file_get_contents(__DIR__ . '/resources/numeric-test.csv'));
        $data = array_map(intval(...), $data);

        return [$data];
    }

    #[DataProvider('passesInvalidCountryCodesDataProvider')]
    public function testPassesInvalidCountryCodes($invalidCountryCode): void
    {
        self::assertFalse($this->rule->passes('attr', $invalidCountryCode));
    }

    public static function passesInvalidCountryCodesDataProvider(): array
    {
        return [[1], [2], [3], [1000], [1001],];
    }

    public function testSetErrorMessage(): void
    {
        $result = $this->rule->setErrorMessage('error');
        self::assertInstanceOf(Iso3166Numeric::class, $result);
    }

    public function testMessage(): void
    {
        $newErrorMessage = 'Oops, form error. Parameter :attribute, Value: :input';
        $this->rule->setErrorMessage($newErrorMessage);
        self::assertEquals($this->rule->message(), $newErrorMessage);
    }
}
