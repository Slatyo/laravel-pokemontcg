<?php

namespace Slatyo\LaravelPokemontcg\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static mixed find(string $pokemonTcgId)
 * @method static mixed search(string $query, int $page = 1, int|string $pageSize = \Slatyo\LaravelPokemontcg\Models\Card::MAXIMUM_PAGE_SIZE, string $orderBy = '')
 * @method static mixed name(string $pokemon, bool $strict = false)
 * @method static mixed whereName(string $pokemon, bool $strict = false)
 * @method static mixed supertype(string $supertype, string $type = '')
 * @method static mixed whereSupertype(string $supertype, string $type = '')
 * @method static mixed pokedex(string $from, string $to)
 * @method static mixed wherePokedex(string $from, string $to)
 * @method static mixed hp(string $from, string $to)
 * @method static mixed whereHp(string $from, string $to)
 */
class Card extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'pokemontcg-card';
    }
}
