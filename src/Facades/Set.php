<?php

namespace Slatyo\LaravelPokemontcg\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static mixed find(string $set)
 * @method static mixed search(string $query, int $page = 1, int|string $pageSize = \Slatyo\LaravelPokemontcg\Models\Set::MAXIMUM_PAGE_SIZE, string $orderBy = '')
 */
class Set extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'pokemontcg-set';
    }
}
