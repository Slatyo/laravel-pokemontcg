This package is currently under construction. 

# Laravel Pokemontcg

[![Latest Version on Packagist](https://img.shields.io/packagist/v/Slatyo/laravel-pokemontcg.svg?style=flat-square)](https://packagist.org/packages/slatyo/laravel-pokemontcg)
[![Total Downloads](https://img.shields.io/packagist/dt/Slatyo/laravel-pokemontcg.svg?style=flat-square)](https://packagist.org/packages/Slatyo/laravel-pokemontcg)
[![run-tests](https://github.com/Slatyo/laravel-pokemontcg/actions/workflows/main.yml/badge.svg)](https://github.com/Slatyo/laravel-pokemontcg/actions/workflows/main.yml)
[![CodeFactor](https://www.codefactor.io/repository/github/slatyo/laravel-pokemontcg/badge)](https://www.codefactor.io/repository/github/slatyo/laravel-pokemontcg)
[![codecov](https://codecov.io/gh/Slatyo/laravel-pokemontcg/branch/main/graph/badge.svg?token=FDG7Q681WL)](https://codecov.io/gh/Slatyo/laravel-pokemontcg)


This package is a simple API laravel wrapper for [Pokemontcg](https://pokemontcg.io) with a sleek Model design
for API routes and authentication.

## Installation
You can install the package via composer:

```bash
composer require slatyo/laravel-pokemontcg
```
The package will automatically register its service provider.  

To publish the config file to `config/pokemontcg.php` run:
```bash
php artisan vendor:publish --provider="Slatyo\LaravelPokemontcg\LaravelPokemontcgServiceProvider"
```

Default content of `config/pokemontcg.php`:
```php
<?php

/*
 * Default configuration to run the pokemontcg.io API
 */
return [
    'url' => env('POKEMONTCG_API_URL', 'https://api.pokemontcg.io/v2'),
    'secret' => env('POKEMONTCG_SECRET'),
];

````

## Usage

### Pokemontcg
``Slatyo\LaravelPokemontcg\Pokemontcg`` is the default wrapper to access everything the
[Pokemontcg](https://pokemontcg.io) API has to offer.

### Supported Models
#### Cards
To access the cards model you have to call:
```php
$cards = Pokemontcg::cards();
```

###### Find by id
Find a specific card by its id:
```php
$cards->find('Test-111');

// or

use \Slatyo\LaravelPokemontcg\Facades\Card;

Card::find('Test-111');
```

###### Search by hp ($from, $to)
Find Pokémon's based on HP:
```php
$from = "1";
$to   = "100";
$cards->hp($from, $to);

// or

use \Slatyo\LaravelPokemontcg\Facades\Card;

Card::hp($from, $to);
Card::whereHp($from, $to); // alias
```

###### Search by name
Find Pokémon's based on their name:
```php
$cards->name('Charizard');

// or

use \Slatyo\LaravelPokemontcg\Facades\Card;

Card::name('Charizard');
Card::whereName('Charizard'); // alias
```

###### Search Pokémon by Pokédex entries ($from, $to)
Find Pokémon's based on their name:
```php
$from = "1";
$to   = "151";
$cards->pokedex($from, $to);

// or

use \Slatyo\LaravelPokemontcg\Facades\Card;

Card::pokedex($from, $to);
Card::wherePokedex($from, $to); // alias
```

###### Search by supertypes
Find Pokémon's by `supertypes` and `types`:
```php
$cards->supertype('mega');
$cards->supertype('mega', 'water');

// or

use \Slatyo\LaravelPokemontcg\Facades\Card;

Card::supertype('mega');
Card::supertype('mega', 'water');
Card::whereSupertype('mega'); // alias
Card::whereSupertype('mega', 'water'); // alias
```

###### Search query
Search Pokémon's based on a query string - for more details on how the query works check out: [Pokemontcg search cards](https://docs.pokemontcg.io/api-reference/cards/search-cards).
```php
$cards->search('name:Char*zard supertype:mega -type:fire');

// or

use \Slatyo\LaravelPokemontcg\Facades\Card;

Card::search('name:Char*zard supertype:mega -type:fire');
```

#### Sets
To access the sets model you have to call:
```php
$sets = Pokemontcg::sets();
```

###### Find by id
Find a specific set by its id:
```php
$sets->find('set-name');

// or

use \Slatyo\LaravelPokemontcg\Facades\Set;

Set::find('set-name');
```

###### Search query
Search Pokémon sets based on a query string - for more details on how the query works check out: [Pokemontcg search sets](https://docs.pokemontcg.io/api-reference/sets/search-cards).
```php
$sets->search('legalities.standard:legal');

// or

use \Slatyo\LaravelPokemontcg\Facades\Set;

Set::search('legalities.standard:legal');
```

#### Supertypes

To access the supertypes model you have to call:
```php
$supertypes = Pokemontcg::supertypes();
```

###### Get all
Return all `supertypes`:
```php
$supertypes->all();

// or

use \Slatyo\LaravelPokemontcg\Facades\Supertype;

Supertype::all();
```

#### Subtypes
To access the subtypes model you have to call:
```php
$subtypes = Pokemontcg::subtypes();
```

###### Get all
Return all `subtypes`:
```php
$subtypes->all();

// or

use \Slatyo\LaravelPokemontcg\Facades\Subtype;

Subtype::all();
```

#### Types
To access the subtypes model you have to call:
```php
$types = Pokemontcg::types();
```

###### Get all
Return all `types`:
```php
$types->all();

// or

use \Slatyo\LaravelPokemontcg\Facades\Type;

Type::all();
```

#### Rarities
To access the rarities model you have to call:
```php
$rarities = Pokemontcg::rarities();
```

###### Get all
Return all `rarities`:
```php
$rarities->all();

// or

use \Slatyo\LaravelPokemontcg\Facades\Rarity;

Rarity::all();
```

### Testing

Executing the testbench:
```bash
composer test
```

Running PHPStan
```bash
composer stan
```

Running PHPStan on windows
```bash
composer stan-2g
```

Generate coverage reports
```bash
composer test:coverage
composer test:coverage-html
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email daniel.henze@outlook.com instead of using the issue tracker.

## Credits

- [Daniel Henze](https://github.com/slatyo)
- [All Contributors](../../contributors)
- This package was generated using the [Laravel Package Boilerplate](https://laravelpackageboilerplate.com).

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
