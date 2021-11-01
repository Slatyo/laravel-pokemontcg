<?php

namespace Slatyo\LaravelPokemontcg\Tests;

use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Http;
use ReflectionException;
use Slatyo\LaravelPokemontcg\LaravelPokemontcgFacade;
use Slatyo\LaravelPokemontcg\Models\Card;
use Slatyo\LaravelPokemontcg\Models\Rarity;
use Slatyo\LaravelPokemontcg\Models\Set;
use Slatyo\LaravelPokemontcg\Models\Subtype;
use Slatyo\LaravelPokemontcg\Models\Supertype;
use Slatyo\LaravelPokemontcg\Models\Type;
use Slatyo\LaravelPokemontcg\Pokemontcg;

class PokemontcgTest extends TestCase
{
    /**
     * @throws ReflectionException
     */
    public function testPokemontcgFacadeAccessor(): void
    {
        $facadeAccessor = $this->invokeMethod(new LaravelPokemontcgFacade, 'getFacadeAccessor');

        $this->assertEquals('pokemontcg', $facadeAccessor);
    }

    public function testPokemontcgFacade(): void
    {
        $pokemontcg = App::make('pokemontcg');
        $this->assertEquals(new Pokemontcg(), $pokemontcg);
        $this->assertEquals(new Card(), $pokemontcg::cards());
        $this->assertEquals(new Set(), $pokemontcg::sets());
        $this->assertEquals(new Rarity(), $pokemontcg::rarities());
        $this->assertEquals(new Subtype(), $pokemontcg::subtypes());
        $this->assertEquals(new Supertype(), $pokemontcg::supertypes());
        $this->assertEquals(new Type(), $pokemontcg::types());
    }

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
            return $request->url() === 'https://api.pokemontcg.io/v2/cards?q=hp%3A%5B1%20TO%2050%5D'
                && $request->method() === 'GET';
        });

        $cards->find('test-11');

        Http::assertSent(function (Request $request) {
            return $request->url() === 'https://api.pokemontcg.io/v2/cards?id=test-11'
                && $request->method() === 'GET';
        });

        $cards->name('charizard', false);

        Http::assertSent(function (Request $request) {
            return $request->url() === 'https://api.pokemontcg.io/v2/cards?q=name%3Acharizard'
                && $request->method() === 'GET';
        });

        $cards->name('charizard', true);

        Http::assertSent(function (Request $request) {
            return $request->url() === 'https://api.pokemontcg.io/v2/cards?q=%21name%3Acharizard'
                && $request->method() === 'GET';
        });

        $cards->pokedex('1', '50');

        Http::assertSent(function (Request $request) {
            return $request->url() === 'https://api.pokemontcg.io/v2/cards?q=nationalPokedexNumbers%3A%5B1%20TO%2050%5D'
                && $request->method() === 'GET';
        });

        $cards->supertype('mega');

        Http::assertSent(function (Request $request) {
            return $request->url() === 'https://api.pokemontcg.io/v2/cards?q=name%3Amega' && $request->method() === 'GET';
        });

        $cards->supertype('mega', 'water');

        Http::assertSent(function (Request $request) {
            return $request->url() === 'https://api.pokemontcg.io/v2/cards?q=name%3Amega%20-types%3Awater' && $request->method() === 'GET';
        });

        $cards->search('!name:charizard subtypes:mega -types:fire');

        Http::assertSent(function (Request $request) {
            return $request->url() === 'https://api.pokemontcg.io/v2/cards?q=%21name%3Acharizard%20subtypes%3Amega%20-types%3Afire&page=1&pageSize=250&orderBy='
                && $request->method() === 'GET';
        });

        $cards->search('!name:charizard subtypes:mega -types:fire', 1, 'max');

        Http::assertSent(function (Request $request) {
            return $request->url() === 'https://api.pokemontcg.io/v2/cards?q=%21name%3Acharizard%20subtypes%3Amega%20-types%3Afire&page=1&pageSize=250&orderBy='
                && $request->method() === 'GET';
        });

        $cards->search('!name:charizard subtypes:mega -types:fire', 1, 237);

        Http::assertSent(function (Request $request) {
            return $request->url() === 'https://api.pokemontcg.io/v2/cards?q=%21name%3Acharizard%20subtypes%3Amega%20-types%3Afire&page=1&pageSize=237&orderBy='
                && $request->method() === 'GET';
        });
    }

    public function testSetEndpoints(): void
    {
        $sets = Pokemontcg::sets();

        $sets->find('random-set');

        Http::assertSent(function (Request $request) {
            return $request->url() === 'https://api.pokemontcg.io/v2/sets/random-set'
                && $request->method() === 'GET';
        });

        $sets->search('legalities.standard:legal');

        Http::assertSent(function (Request $request) {
            return $request->url() === 'https://api.pokemontcg.io/v2/sets?q=legalities.standard%3Alegal&page=1&pageSize=250&orderBy='
                && $request->method() === 'GET';
        });

        $sets->search('legalities.standard:legal', 1, 'max');

        Http::assertSent(function (Request $request) {
            return $request->url() === 'https://api.pokemontcg.io/v2/sets?q=legalities.standard%3Alegal&page=1&pageSize=250&orderBy='
                && $request->method() === 'GET';
        });

        $sets->search('legalities.standard:legal', 1, 237);

        Http::assertSent(function (Request $request) {
            return $request->url() === 'https://api.pokemontcg.io/v2/sets?q=legalities.standard%3Alegal&page=1&pageSize=237&orderBy='
                && $request->method() === 'GET';
        });
    }

    public function testSupertypeEndpoints(): void
    {
        $supertypes = Pokemontcg::supertypes();

        $supertypes->all();

        Http::assertSent(function (Request $request) {
            return $request->url() === 'https://api.pokemontcg.io/v2/supertypes'
                && $request->method() === 'GET';
        });
    }

    public function testSubtypeEndpoints(): void
    {
        $supertypes = Pokemontcg::subtypes();

        $supertypes->all();

        Http::assertSent(function (Request $request) {
            return $request->url() === 'https://api.pokemontcg.io/v2/subtypes'
                && $request->method() === 'GET';
        });
    }

    public function testTypeEndpoints(): void
    {
        $supertypes = Pokemontcg::types();

        $supertypes->all();

        Http::assertSent(function (Request $request) {
            return $request->url() === 'https://api.pokemontcg.io/v2/types'
                && $request->method() === 'GET';
        });
    }

    public function testRarityEndpoints(): void
    {
        $supertypes = Pokemontcg::rarities();

        $supertypes->all();

        Http::assertSent(function (Request $request) {
            return $request->url() === 'https://api.pokemontcg.io/v2/rarities'
                && $request->method() === 'GET';
        });
    }
}
