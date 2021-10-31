<?php

namespace Slaty\LaravelPokemontcg;

use Slaty\LaravelPokemontcg\Models\Card;
use Slaty\LaravelPokemontcg\Models\Rarity;
use Slaty\LaravelPokemontcg\Models\Set;
use Slaty\LaravelPokemontcg\Models\Subtype;
use Slaty\LaravelPokemontcg\Models\Supertype;
use Slaty\LaravelPokemontcg\Models\Type;

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