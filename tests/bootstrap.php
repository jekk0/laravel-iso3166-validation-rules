<?php
if (file_exists($file = __DIR__ . "/../vendor/autoload.php")) {
    require_once $file;
}
/*Interfaces*/
require_once __DIR__ . "/../src/Interfaces/CountryCodes.php";
/* Classes */
require_once __DIR__ . "/../src/Classes/CountryCodes.php";
require_once __DIR__ . "/../src/Classes/CountryCodes.php";
/* Rules */
require_once __DIR__ . "/../src/Iso3166Alpha2.php";
require_once __DIR__ . "/../src/Iso3166Alpha3.php";
require_once __DIR__ . "/../src/Iso3166Numeric.php";