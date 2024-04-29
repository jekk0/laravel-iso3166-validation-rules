<?php

declare(strict_types=1);

namespace Jekk0\Laravel\Iso3166\Validation\Rules\Classes;

use Illuminate\Contracts\Validation\Rule;

abstract class Iso3166BaseRule implements Rule
{
    protected Iso3166Validator $validator;

    protected string $message = "The :input is not valid country code.";

    public function __construct()
    {
        $this->validator = new Iso3166Validator(new CountryCodes());
    }

    public function setErrorMessage(string $message): static
    {
        $this->message = $message;

        return $this;
    }

    public function message(): string
    {
        return $this->message;
    }

    abstract public function passes($attribute, $value);
}
