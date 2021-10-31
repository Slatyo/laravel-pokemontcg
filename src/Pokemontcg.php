<?php

namespace Slatyo\LaravelPokemontcg;

use Slatyo\LaravelPokemontcg\Models\Card;
use Slatyo\LaravelPokemontcg\Models\Rarity;
use Slatyo\LaravelPokemontcg\Models\Set;
use Slatyo\LaravelPokemontcg\Models\Subtype;
use Slatyo\LaravelPokemontcg\Models\Supertype;
use Slatyo\LaravelPokemontcg\Models\Type;

class Pokemontcg
{
    /**
     * @return Card
     */
    public static function cards(): Card
    {
        return new Card();
    }

    /**
     * @return Rarity
     */
    public static function rarities(): Rarity
    {
        return new Rarity();
    }

    /**
     * @return Set
     */
    public static function sets(): Set
    {
        return new Set();
    }

    /**
     * @return Supertype
     */
    public static function supertypes(): Supertype
    {
        return new Supertype();
    }

    /**
     * @return Subtype
     */
    public static function subtypes(): Subtype
    {
        return new Subtype();
    }

    /**
     * @return Type
     */
    public static function types(): Type
    {
        return new Type();
    }
}