<?php

namespace Slatyo\LaravelPokemontcg;

use Illuminate\Support\Facades\Facade;

class LaravelPokemontcgFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'pokemontcg';
    }
}
