<?php

declare(strict_types=1);

namespace Jekk0\Laravel\Iso3166\Validation\Rules\Classes;

use Jekk0\Laravel\Iso3166\Validation\Rules\Interfaces\CountryCodes as CountryCodesInterface;

class CountryCodes implements CountryCodesInterface
{
    private const RESOURCE_PATH = __DIR__ . '/../resources/';
    private const ALPHA_2_FILENAME = 'alpha2.csv';
    private const ALPHA_3_FILENAME = 'alpha3.csv';
    private const NUMERIC_FILENAME = 'numeric.csv';

    public function getAlpha2Codes(): array
    {
        return str_getcsv(file_get_contents(self::RESOURCE_PATH . self::ALPHA_2_FILENAME));
    }

    public function getAlpha3Codes(): array
    {
        return str_getcsv(file_get_contents(self::RESOURCE_PATH . self::ALPHA_3_FILENAME));
    }

    public function getNumericCodes(): array
    {
        return array_map(intval(...), str_getcsv(file_get_contents(self::RESOURCE_PATH . self::NUMERIC_FILENAME)));
    }
}
