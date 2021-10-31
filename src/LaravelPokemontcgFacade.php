<?php

namespace Slaty\LaravelPokemontcg;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Slaty\LaravelPokemontcg\Skeleton\SkeletonClass
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
