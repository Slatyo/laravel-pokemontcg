<?php

namespace Slaty\LaravelPokemontcg\Tests;

use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use Slaty\LaravelPokemontcg\Models\Card;
use Slaty\LaravelPokemontcg\Models\Rarity;
use Slaty\LaravelPokemontcg\Models\Set;
use Slaty\LaravelPokemontcg\Models\Subtype;
use Slaty\LaravelPokemontcg\Models\Supertype;
use Slaty\LaravelPokemontcg\Models\Type;
use Slaty\LaravelPokemontcg\Pokemontcg;

class PokemontcgTest extends TestCase
{
    public function testStaticMethods(): void
    {
        $this->assertEquals(new Card(), Pokemontcg::cards());
        $this->assertEquals(new Set(), Pokemontcg::sets());
        $this->assertEquals(new Rarity(), Pokemontcg::rarities());
        $this->assertEquals(new Subtype(), Pokemontcg::subtypes());
        $this->assertEquals(new Supertype(), Pokemontcg::supertypes());
        $this->assertEquals(new Type(), Pokemontcg::types());
    }

    public function testCardEndpoints(): void
    {
        $cards = Pokemontcg::cards();
        $cards->hp('1', '50');

        Http::assertSent(function (Request $request) {
            return $request->url() === 'https://api.pokemontcg.io/cards?q=hp%3A%5B1%20TO%2050%5D' && $request->method() === 'GET';
        });
    }
}
