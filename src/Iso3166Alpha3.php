<?php

declare(strict_types=1);

namespace Jekk0\Laravel\Iso3166\Validation\Rules;

use Closure;
use Jekk0\Laravel\Iso3166\Validation\Rules\Classes\Iso3166BaseRule;

class Iso3166Alpha3 extends Iso3166BaseRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (is_string($value)
            && strlen($value) === 3
            && $this->validator->isValidAlpha3CountryCode($value) === true) {
            return;
        }

        $fail($this->getMessage());
    }
}
