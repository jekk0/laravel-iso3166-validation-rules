# Laravel/Lumen validation rules for Country Codes - ISO 3166-1
![Build Status](https://github.com/jekk0/laravel-iso3166-validation-rules/actions/workflows/pipeline.yml/badge.svg?branch=master)
[![Coverage Status](https://codecov.io/gh/jekk0/laravel-iso3166-validation-rules/branch/master/graphs/badge.svg)](https://codecov.io/gh/jekk0/laravel-iso3166-validation-rules)
[![Latest Stable Version](https://poser.pugx.org/jekk0/laravel-iso3166-validation-rules/v/stable)](https://packagist.org/packages/jekk0/laravel-iso3166-validation-rules)
[![Total Downloads](https://poser.pugx.org/jekk0/laravel-iso3166-validation-rules/downloads)](https://packagist.org/packages/jekk0/laravel-iso3166-validation-rules)

### Requirements

 * Laravel/Lumen 5.8.x (version 1.0.1)
 * Laravel/Lumen 6.0.x (version 1.1.0)
 * Laravel/Lumen 7.0.x (version 1.2.0)
 * Laravel/Lumen 8.0.x (version 1.3.0)
 * Laravel/Lumen 9.0.x (version 1.4.0)
 * Laravel/Lumen 10.0.x (version 1.5.0)
 * Laravel/Lumen 11.0.x (version 1.6.1)
 * Laravel/Lumen 12.0.x (version 1.7.0)

### Installation

 Install the latest version with
```
 $ composer require jekk0/laravel-iso3166-validation-rules
```

### Quick start.
#### Using in controller
```php
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Jekk0\Laravel\Iso3166\Validation\Rules\Iso3166Alpha2;

class Test extends Controller
{
    public function index(Request $request)
    {
        // Request example: http://127.0.0.1:8000/t?country=us

        $rules = ['country' => ['required', new Iso3166Alpha2()]]; // ISO3166-1 Alpha2 validation rule

        try {
            $request->validate($rules);
        } catch (\Exception $exception) {
            dd('Country code is invalid: ' . $exception->getMessage());
        }

        dd('Country code is valid: ' . $request->get('country'));
    }
}

```

#### Available rules
```php
<?php
use Jekk0\Laravel\Iso3166\Validation\Rules\Iso3166Alpha2;
use Jekk0\Laravel\Iso3166\Validation\Rules\Iso3166Alpha3;
use Jekk0\Laravel\Iso3166\Validation\Rules\Iso3166Numeric;

$rules = ['countryAlpha2' => ['required', new Iso3166Alpha2()]]; // ISO3166-1 Alpha2 validation rule
$rules = ['countryAlpha3' => ['required', new Iso3166Alpha3()]]; // ISO3166-1 Alpha3 validation rule
$rules = ['countryNumeric' => ['required', new Iso3166Numeric()]]; // ISO3166-1 Numeric validation rule
```
#### Customise error message
```php
<?php
...
    public function index(Request $request)
    {
        // Request example: http://127.0.0.1:8000/t?country=INVALID_INPUT

        $iso3166Alpha2Rule = (new Iso3166Alpha2())->setErrorMessage('New Custom Error Message :attribute = :input');

        $rules = ['country' => ['required', $iso3166Alpha2Rule]]; // ISO3166-1 Alpha2 validation rule

        try {
            $request->validate($rules);
        } catch (\Exception $exception) {
            dd('Country code is invalid: ' . $exception->getMessage());
        }

        dd('Country code is valid: ' . $request->get('country'));
    }
    
    // Output
    // Country code is invalid: New Custom Error Message country = INVALID_INPUT
```
Laravel/Lumen automatically parse error message and replace: 
 * :attribute -> form parameter name 
 * :input     -> form parameter value 

### Docs
 * Country Codes - ISO 3166: https://www.iso.org/iso-3166-country-codes.html
 * ISO 3166-1: https://en.wikipedia.org/wiki/ISO_3166-1
