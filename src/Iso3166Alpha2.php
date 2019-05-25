<?php

namespace Jekk0\laravel\Iso3166\Validation\Rules;

use Illuminate\Contracts\Validation\Rule;
use Jekk0\laravel\Iso3166\Validation\Rules\Classes\CountryCodes;
use Jekk0\laravel\Iso3166\Validation\Rules\Classes\Iso3166Validator;

class Iso3166Alpha2 implements Rule
{
    protected $validator;

    public function __construct()
    {
        $this->validator = new Iso3166Validator(new CountryCodes());
    }

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
        $this->validator->isValidAlpha2CountryCode((string)$value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return "The :attribute is invalid country code.";
    }
}
