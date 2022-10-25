<?php

namespace Jekk0\laravel\Iso3166\Validation\Rules\Tests;

use Jekk0\laravel\Iso3166\Validation\Rules\Classes\CountryCodes;
use Jekk0\laravel\Iso3166\Validation\Rules\Iso3166Alpha3;
use PHPUnit\Framework\TestCase;

class Iso3166Alpha3Test extends TestCase
{
    protected Iso3166Alpha3 $rule;

    protected function setUp(): void
    {
        $this->rule = new Iso3166Alpha3();
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
        $availableCountryCodes = (new CountryCodes())->getAlpha3Codes();
        $data = [];
        foreach ($availableCountryCodes as $countryCode) {
            $data[$countryCode] = $countryCode;
        }

        return [$data];
    }

    public function testPassesInvalidStringLength(): void
    {
        $this->assertFalse($this->rule->passes('attr', 'AAAA'));
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
        return [['xxx'], ['XXX'], ['zzz'], ['ZZZ'],];
    }

    public function testSetErrorMessage(): void
    {
        $result = $this->rule->setErrorMessage('error');
        $this->assertInstanceOf(Iso3166Alpha3::class, $result);
    }

    public function testMessage(): void
    {
        $newErrorMessage = 'Oops, form error. Parameter :attribute, Value: :input';
        $this->rule->setErrorMessage($newErrorMessage);
        $this->assertEquals($this->rule->message(), $newErrorMessage);
    }
}
