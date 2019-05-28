<?php

namespace Jekk0\laravel\Iso3166\Validation\Rules;

use Jekk0\laravel\Iso3166\Validation\Rules\Classes\Iso3166BaseRule;

class Iso3166Alpha2 extends Iso3166BaseRule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string $attribute
     * @param  mixed  $value
     *
     * @return bool
     *
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function passes($attribute, $value)
    {
        return $this->validator->isValidAlpha2CountryCode((string)$value);
    }
}
