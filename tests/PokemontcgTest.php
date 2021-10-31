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
            return $request->url() === 'https://api.pokemontcg.io/cards?q=hp%3A%5B1%20TO%2050%5D'
                && $request->method() === 'GET';
        });

        $cards->find('test-11');

        Http::assertSent(function (Request $request) {
            return $request->url() === 'https://api.pokemontcg.io/cards?id=test-11'
                && $request->method() === 'GET';
        });

        $cards->name('charizard', false);

        Http::assertSent(function (Request $request) {
            return $request->url() === 'https://api.pokemontcg.io/cards?q=name%3Acharizard'
                && $request->method() === 'GET';
        });

        $cards->name('charizard', true);

        Http::assertSent(function (Request $request) {
            return $request->url() === 'https://api.pokemontcg.io/cards?q=%21name%3Acharizard'
                && $request->method() === 'GET';
        });

        $cards->pokedex('1', '50');

        Http::assertSent(function (Request $request) {
            return $request->url() === 'https://api.pokemontcg.io/cards?q=nationalPokedexNumbers%3A%5B1%20TO%2050%5D'
                && $request->method() === 'GET';
        });

        $cards->supertype('mega');

        Http::assertSent(function (Request $request) {
            return $request->url() === 'https://api.pokemontcg.io/cards?q=name%3Amega' && $request->method() === 'GET';
        });

        $cards->supertype('mega', 'water');

        Http::assertSent(function (Request $request) {
            return $request->url() === 'https://api.pokemontcg.io/cards?q=name%3Amega%20-types%3Awater' && $request->method() === 'GET';
        });

        $cards->search('!name:charizard subtypes:mega -types:fire');

        Http::assertSent(function (Request $request) {
            return $request->url() === 'https://api.pokemontcg.io/cards?q=%21name%3Acharizard%20subtypes%3Amega%20-types%3Afire&page=1&pageSize=250&orderBy='
                && $request->method() === 'GET';
        });
    }

    public function testSetEndpoints(): void
    {
        $sets = Pokemontcg::sets();

        $sets->find('random-set');

        Http::assertSent(function (Request $request) {
            return $request->url() === 'https://api.pokemontcg.io/sets/random-set'
                && $request->method() === 'GET';
        });

        $sets->search('legalities.standard:legal');

        Http::assertSent(function (Request $request) {
            return $request->url() === 'https://api.pokemontcg.io/sets?q=legalities.standard%3Alegal&page=1&pageSize=250&orderBy='
                && $request->method() === 'GET';
        });
    }

    public function testSupertypeEndpoints(): void
    {
        $supertypes = Pokemontcg::supertypes();

        $supertypes->all();

        Http::assertSent(function (Request $request) {
            return $request->url() === 'https://api.pokemontcg.io/supertypes'
                && $request->method() === 'GET';
        });
    }

    public function testSubtypeEndpoints(): void
    {
        $supertypes = Pokemontcg::subtypes();

        $supertypes->all();

        Http::assertSent(function (Request $request) {
            return $request->url() === 'https://api.pokemontcg.io/subtypes'
                && $request->method() === 'GET';
        });
    }

    public function testTypeEndpoints(): void
    {
        $supertypes = Pokemontcg::types();

        $supertypes->all();

        Http::assertSent(function (Request $request) {
            return $request->url() === 'https://api.pokemontcg.io/types'
                && $request->method() === 'GET';
        });
    }

    public function testRarityEndpoints(): void
    {
        $supertypes = Pokemontcg::rarities();

        $supertypes->all();

        Http::assertSent(function (Request $request) {
            return $request->url() === 'https://api.pokemontcg.io/rarities'
                && $request->method() === 'GET';
        });
    }
}
