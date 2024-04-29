<?php

declare(strict_types=1);

namespace Jekk0\Laravel\Iso3166\Validation\Rules\Interfaces;

interface CountryCodes
{
    public function getAlpha2Codes(): array;

    public function getAlpha3Codes(): array;

    public function getNumericCodes(): array;
}
