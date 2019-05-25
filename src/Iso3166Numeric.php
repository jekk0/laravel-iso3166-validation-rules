<?php

namespace Jekk0\laravel\Iso3166\Validation\Rules;

class Iso3166Numeric extends Iso3166Alpha2
{
    public function passes($attribute, $value)
    {
        return $this->validator->isValidNumericCountryCode((int)$value);
    }
}
