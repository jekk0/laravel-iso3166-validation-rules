<?php

namespace Jekk0\laravel\Iso3166\Validation\Rules;

use Jekk0\laravel\Iso3166\Validation\Rules\Classes\Iso3166BaseRule;

class Iso3166Numeric extends Iso3166BaseRule
{
    public function passes($attribute, $value)
    {
        return $this->validator->isValidNumericCountryCode((int)$value);
    }
}
