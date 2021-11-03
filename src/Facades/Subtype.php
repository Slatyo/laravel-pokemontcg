<?php

namespace Slatyo\LaravelPokemontcg\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static mixed all()
 */
class Subtype extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'pokemontcg-subtype';
    }
}
