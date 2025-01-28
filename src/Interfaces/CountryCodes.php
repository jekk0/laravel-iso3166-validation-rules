<?php

declare(strict_types=1);

namespace Jekk0\Laravel\Iso3166\Validation\Rules\Interfaces;

interface CountryCodes
{
    /**
     * @return array<int, string>
     */
    public function getAlpha2Codes(): array;

    /**
     * @return array<int, string>
     */
    public function getAlpha3Codes(): array;

    /**
     * @return array<int, int>
     */
    public function getNumericCodes(): array;
}
