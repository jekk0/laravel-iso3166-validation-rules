<?php

namespace Jekk0\laravel\Iso3166\Validation\Rules;

class Iso3166Alpha3 extends Iso3166Alpha2
{
    public function passes($attribute, $value)
    {
        $this->validator->isValidAlpha3CountryCode((string)$value);
    }
}
