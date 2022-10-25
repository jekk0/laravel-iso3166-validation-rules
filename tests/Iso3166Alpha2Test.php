<?php

namespace Jekk0\laravel\Iso3166\Validation\Rules\Tests;

use Jekk0\laravel\Iso3166\Validation\Rules\Classes\CountryCodes;
use Jekk0\laravel\Iso3166\Validation\Rules\Iso3166Alpha2;
use PHPUnit\Framework\TestCase;

class Iso3166Alpha2Test extends TestCase
{
    protected Iso3166Alpha2 $rule;

    protected function setUp(): void
    {
        $this->rule = new Iso3166Alpha2();
    }

    /**
     * @param $countryCode
     *
     * @dataProvider passesSuccessDataProvider
     */
    public function testPassesSuccess($countryCode): void
    {
        $this->assertTrue($this->rule->passes('attr', $countryCode));
    }

    public function passesSuccessDataProvider(): array
    {
        $availableCountryCodes = (new CountryCodes())->getAlpha2Codes();
        $data = [];
        foreach ($availableCountryCodes as $countryCode) {
            $data[$countryCode] = $countryCode;
        }

        return [$data];
    }

    public function testPassesInvalidStringLength(): void
    {
        $this->assertFalse($this->rule->passes('attr', 'UUU'));
    }

    /**
     * @param $invalidCountryCode
     *
     * @dataProvider passesInvalidCountryCodesDataProvider
     */
    public function testPassesInvalidCountryCodes($invalidCountryCode): void
    {
        $this->assertFalse($this->rule->passes('attr', $invalidCountryCode));
    }

    public function passesInvalidCountryCodesDataProvider(): array
    {
        return [['xx'], ['XX'], ['zz'], ['ZZ'],];
    }

    public function testSetErrorMessage(): void
    {
        $result = $this->rule->setErrorMessage('error');
        $this->assertInstanceOf(Iso3166Alpha2::class, $result);
    }

    public function testMessage(): void
    {
        $newErrorMessage = 'Oops, form error. Parameter :attribute, Value: :input';
        $this->rule->setErrorMessage($newErrorMessage);
        $this->assertEquals($this->rule->message(), $newErrorMessage);
    }
}
