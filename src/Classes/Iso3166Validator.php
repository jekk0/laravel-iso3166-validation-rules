<?php

namespace Jekk0\laravel\Iso3166\Validation\Rules\Classes;

use Jekk0\laravel\Iso3166\Validation\Rules\Interfaces\CountryCodes as CountryCodesInterface;

class Iso3166Validator
{
    public function __construct(
        private CountryCodesInterface $countryCodes)
    {}

    public function isValidAlpha2CountryCode(string $alpha2CountryCode) : bool
    {
        if (strlen($alpha2CountryCode) !== 2) {
            return false;
        }

        return in_array(strtoupper($alpha2CountryCode), $this->countryCodes->getAlpha2Codes(), true);
    }

    public function isValidAlpha3CountryCode(string $alpha3CountryCode) : bool
    {
        if (strlen($alpha3CountryCode) !== 3) {
            return false;
        }

        return in_array(strtoupper($alpha3CountryCode), $this->countryCodes->getAlpha3Codes(), true);
    }

    public function isValidNumericCountryCode(int $numericCountryCode) : bool
    {
        return in_array($numericCountryCode, $this->countryCodes->getNumericCodes(), true);
    }
}
