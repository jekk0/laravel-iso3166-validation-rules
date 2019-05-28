<?php

namespace Jekk0\laravel\Iso3166\Validation\Rules\Tests;

use Jekk0\laravel\Iso3166\Validation\Rules\Classes\CountryCodes;
use Jekk0\laravel\Iso3166\Validation\Rules\Iso3166Numeric;

class Iso3166NumericTest extends \PHPUnit\Framework\TestCase
{
    protected $rule;

    protected function setUp(): void
    {
        $this->rule = new Iso3166Numeric();
    }

    /**
     * @param $countryCode
     *
     * @dataProvider passesSuccessDataProvider
     */
    public function testPassesSuccess($countryCode)
    {
        $this->assertTrue($this->rule->passes('attr', $countryCode));
    }

    public function passesSuccessDataProvider()
    {
        $availableCountryCodes = (new CountryCodes())->getNumericCodes();
        $data = [];
        foreach ($availableCountryCodes as $countryCode) {
            $data[$countryCode] = $countryCode;
        }

        return [
            $data
        ];
    }

    /**
     * @param $invalidCountryCode
     *
     * @dataProvider passesInvalidCountryCodesDataProvider
     */
    public function testPassesInvalidCountryCodes($invalidCountryCode)
    {
        $this->assertFalse($this->rule->passes('attr', $invalidCountryCode));
    }

    public function passesInvalidCountryCodesDataProvider()
    {
        return [[1], [2], [3], [1000], [1001],];
    }

    public function testMessage()
    {
        $newErrorMessage = 'Ooops, form error. Parameter :attribute, Value: :input';
        $this->rule->setErrorMessage($newErrorMessage);
        $this->assertEquals($this->rule->message(), $newErrorMessage);
    }
}
