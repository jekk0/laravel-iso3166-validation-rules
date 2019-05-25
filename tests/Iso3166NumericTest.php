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

    public function testPassesSuccess()
    {
        $availableCountryCodes = (new CountryCodes())->getNumericCodes();

        foreach ($availableCountryCodes as $countryCode) {
            $this->assertTrue($this->rule->passes('attr', $countryCode));
        }
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
        return [
            1, 2, 3, 1000, 1001,
        ];
    }

    public function testMessage()
    {
        $this->assertTrue(is_string($this->rule->message()));
    }
}
