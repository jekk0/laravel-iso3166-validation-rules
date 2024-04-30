<?php

declare(strict_types=1);

namespace Jekk0\Laravel\Iso3166\Validation\Rules;

use Jekk0\Laravel\Iso3166\Validation\Rules\Classes\Iso3166BaseRule;

class Iso3166Alpha3 extends Iso3166BaseRule
{
    public function passes($attribute, $value)
    {
        return $this->validator->isValidAlpha3CountryCode((string)$value);
    }
}
