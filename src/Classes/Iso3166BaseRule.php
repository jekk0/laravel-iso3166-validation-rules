<?php

namespace Jekk0\laravel\Iso3166\Validation\Rules\Classes;

use Illuminate\Contracts\Validation\Rule;

abstract class Iso3166BaseRule implements Rule
{
    protected $validator;

    protected $message = "The :input is not valid country code.";

    public function __construct()
    {
        $this->validator = new Iso3166Validator(new CountryCodes());
    }

    public function setErrorMessage(string $message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return $this->message;
    }

    abstract function passes($attribute, $value);
}
