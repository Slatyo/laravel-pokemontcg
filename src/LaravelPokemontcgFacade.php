<?php

namespace Slatyo\LaravelPokemontcg;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Slatyo\LaravelPokemontcg\Skeleton\SkeletonClass
 */
class LaravelPokemontcgFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'laravel-pokemontcg';
    }
}
