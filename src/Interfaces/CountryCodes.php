<?php

namespace Jekk0\laravel\Iso3166\Validation\Rules\Interfaces;

interface CountryCodes
{
    public function getAlpha2Codes(): array;

    public function getAlpha3Codes(): array;

    public function getNumericCodes(): array;

}