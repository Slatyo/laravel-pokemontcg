<?php

namespace Slatyo\LaravelPokemontcg\Tests;

use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Http;
use ReflectionException;
use Slatyo\LaravelPokemontcg\Facades\Card as CardFacade;
use Slatyo\LaravelPokemontcg\Facades\Rarity as RarityFacade;
use Slatyo\LaravelPokemontcg\Facades\Set as SetFacade;
use Slatyo\LaravelPokemontcg\Facades\Subtype as SubtypeFacade;
use Slatyo\LaravelPokemontcg\Facades\Supertype as SupertypeFacade;
use Slatyo\LaravelPokemontcg\Facades\Type as TypeFacade;
use Slatyo\LaravelPokemontcg\Facades\Pokemontcg as PokemontcgFacade;
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
        $facadeAccessor = $this->invokeMethod(new PokemontcgFacade, 'getFacadeAccessor');

        $this->assertEquals('pokemontcg', $facadeAccessor);
    }

    /**
     * @throws ReflectionException
     */
    public function testCardFacadeAccessor(): void
    {
        $facadeAccessor = $this->invokeMethod(new CardFacade, 'getFacadeAccessor');

        $this->assertEquals('pokemontcg-card', $facadeAccessor);
    }

    /**
     * @throws ReflectionException
     */
    public function testRarityFacadeAccessor(): void
    {
        $facadeAccessor = $this->invokeMethod(new RarityFacade, 'getFacadeAccessor');

        $this->assertEquals('pokemontcg-rarity', $facadeAccessor);
    }

    /**
     * @throws ReflectionException
     */
    public function testSetFacadeAccessor(): void
    {
        $facadeAccessor = $this->invokeMethod(new SetFacade, 'getFacadeAccessor');

        $this->assertEquals('pokemontcg-set', $facadeAccessor);
    }

    /**
     * @throws ReflectionException
     */
    public function testSubtypeFacadeAccessor(): void
    {
        $facadeAccessor = $this->invokeMethod(new SubtypeFacade, 'getFacadeAccessor');

        $this->assertEquals('pokemontcg-subtype', $facadeAccessor);
    }

    /**
     * @throws ReflectionException
     */
    public function testSupertypeFacadeAccessor(): void
    {
        $facadeAccessor = $this->invokeMethod(new SupertypeFacade, 'getFacadeAccessor');

        $this->assertEquals('pokemontcg-supertype', $facadeAccessor);
    }

    /**
     * @throws ReflectionException
     */
    public function testTypeFacadeAccessor(): void
    {
        $facadeAccessor = $this->invokeMethod(new TypeFacade, 'getFacadeAccessor');

        $this->assertEquals('pokemontcg-type', $facadeAccessor);
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

    public function testCardFacade(): void
    {
        $card = App::make('pokemontcg-card');
        $this->assertEquals(new Card(), $card);
    }

    public function testRarityFacade(): void
    {
        $rarity = App::make('pokemontcg-rarity');
        $this->assertEquals(new Rarity(), $rarity);
    }

    public function testSetFacade(): void
    {
        $set = App::make('pokemontcg-set');
        $this->assertEquals(new Set(), $set);
    }

    public function testSubtypeFacade(): void
    {
        $subtype = App::make('pokemontcg-subtype');
        $this->assertEquals(new Subtype(), $subtype);
    }

    public function testSupertypeFacade(): void
    {
        $supertype = App::make('pokemontcg-supertype');
        $this->assertEquals(new Supertype(), $supertype);
    }

    public function testTypeFacade(): void
    {
        $type = App::make('pokemontcg-type');
        $this->assertEquals(new Type(), $type);
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

        $cards->whereHp('2', '51');

        Http::assertSent(function (Request $request) {
            return $request->url() === 'https://api.pokemontcg.io/v2/cards?q=hp%3A%5B2%20TO%2051%5D'
                && $request->method() === 'GET';
        });

        $cards->find('test-11');

        Http::assertSent(function (Request $request) {
            return $request->url() === 'https://api.pokemontcg.io/v2/cards/test-11'
                && $request->method() === 'GET';
        });

        $cards->name('charizard', false);

        Http::assertSent(function (Request $request) {
            return $request->url() === 'https://api.pokemontcg.io/v2/cards?q=name%3Acharizard'
                && $request->method() === 'GET';
        });

        $cards->whereName('pikatchu', false);

        Http::assertSent(function (Request $request) {
            return $request->url() === 'https://api.pokemontcg.io/v2/cards?q=name%3Apikatchu'
                && $request->method() === 'GET';
        });

        $cards->name('charizard', true);

        Http::assertSent(function (Request $request) {
            return $request->url() === 'https://api.pokemontcg.io/v2/cards?q=%21name%3Acharizard'
                && $request->method() === 'GET';
        });

        $cards->whereName('pikatchu', true);

        Http::assertSent(function (Request $request) {
            return $request->url() === 'https://api.pokemontcg.io/v2/cards?q=%21name%3Apikatchu'
                && $request->method() === 'GET';
        });

        $cards->pokedex('1', '50');

        Http::assertSent(function (Request $request) {
            return $request->url() === 'https://api.pokemontcg.io/v2/cards?q=nationalPokedexNumbers%3A%5B1%20TO%2050%5D'
                && $request->method() === 'GET';
        });

        $cards->wherePokedex('2', '51');

        Http::assertSent(function (Request $request) {
            return $request->url() === 'https://api.pokemontcg.io/v2/cards?q=nationalPokedexNumbers%3A%5B2%20TO%2051%5D'
                && $request->method() === 'GET';
        });

        $cards->supertype('mega');

        Http::assertSent(function (Request $request) {
            return $request->url() === 'https://api.pokemontcg.io/v2/cards?q=name%3Amega' && $request->method() === 'GET';
        });

        $cards->whereSupertype('ultra');

        Http::assertSent(function (Request $request) {
            return $request->url() === 'https://api.pokemontcg.io/v2/cards?q=name%3Aultra' && $request->method() === 'GET';
        });

        $cards->supertype('mega', 'water');

        Http::assertSent(function (Request $request) {
            return $request->url() === 'https://api.pokemontcg.io/v2/cards?q=name%3Amega%20-types%3Awater' && $request->method() === 'GET';
        });

        $cards->whereSupertype('ultra', 'fire');

        Http::assertSent(function (Request $request) {
            return $request->url() === 'https://api.pokemontcg.io/v2/cards?q=name%3Aultra%20-types%3Afire' && $request->method() === 'GET';
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

    public function testStaticCardEndpoints(): void
    {
        CardFacade::hp('1', '50');

        Http::assertSent(function (Request $request) {
            return $request->url() === 'https://api.pokemontcg.io/v2/cards?q=hp%3A%5B1%20TO%2050%5D'
                && $request->method() === 'GET';
        });

        CardFacade::whereHp('2', '51');

        Http::assertSent(function (Request $request) {
            return $request->url() === 'https://api.pokemontcg.io/v2/cards?q=hp%3A%5B2%20TO%2051%5D'
                && $request->method() === 'GET';
        });

        CardFacade::find('test-11');

        Http::assertSent(function (Request $request) {
            return $request->url() === 'https://api.pokemontcg.io/v2/cards/test-11'
                && $request->method() === 'GET';
        });

        CardFacade::name('charizard', false);

        Http::assertSent(function (Request $request) {
            return $request->url() === 'https://api.pokemontcg.io/v2/cards?q=name%3Acharizard'
                && $request->method() === 'GET';
        });

        CardFacade::whereName('pikatchu', false);

        Http::assertSent(function (Request $request) {
            return $request->url() === 'https://api.pokemontcg.io/v2/cards?q=name%3Apikatchu'
                && $request->method() === 'GET';
        });

        CardFacade::name('charizard', true);

        Http::assertSent(function (Request $request) {
            return $request->url() === 'https://api.pokemontcg.io/v2/cards?q=%21name%3Acharizard'
                && $request->method() === 'GET';
        });

        CardFacade::whereName('pikatchu', true);

        Http::assertSent(function (Request $request) {
            return $request->url() === 'https://api.pokemontcg.io/v2/cards?q=%21name%3Apikatchu'
                && $request->method() === 'GET';
        });

        CardFacade::pokedex('1', '50');

        Http::assertSent(function (Request $request) {
            return $request->url() === 'https://api.pokemontcg.io/v2/cards?q=nationalPokedexNumbers%3A%5B1%20TO%2050%5D'
                && $request->method() === 'GET';
        });

        CardFacade::wherePokedex('2', '51');

        Http::assertSent(function (Request $request) {
            return $request->url() === 'https://api.pokemontcg.io/v2/cards?q=nationalPokedexNumbers%3A%5B2%20TO%2051%5D'
                && $request->method() === 'GET';
        });

        CardFacade::supertype('mega');

        Http::assertSent(function (Request $request) {
            return $request->url() === 'https://api.pokemontcg.io/v2/cards?q=name%3Amega' && $request->method() === 'GET';
        });

        CardFacade::whereSupertype('ultra');

        Http::assertSent(function (Request $request) {
            return $request->url() === 'https://api.pokemontcg.io/v2/cards?q=name%3Aultra' && $request->method() === 'GET';
        });

        CardFacade::supertype('mega', 'water');

        Http::assertSent(function (Request $request) {
            return $request->url() === 'https://api.pokemontcg.io/v2/cards?q=name%3Amega%20-types%3Awater' && $request->method() === 'GET';
        });

        CardFacade::whereSupertype('ultra', 'fire');

        Http::assertSent(function (Request $request) {
            return $request->url() === 'https://api.pokemontcg.io/v2/cards?q=name%3Aultra%20-types%3Afire' && $request->method() === 'GET';
        });

        CardFacade::search('!name:charizard subtypes:mega -types:fire');

        Http::assertSent(function (Request $request) {
            return $request->url() === 'https://api.pokemontcg.io/v2/cards?q=%21name%3Acharizard%20subtypes%3Amega%20-types%3Afire&page=1&pageSize=250&orderBy='
                && $request->method() === 'GET';
        });

        CardFacade::search('!name:charizard subtypes:mega -types:fire', 1, 'max');

        Http::assertSent(function (Request $request) {
            return $request->url() === 'https://api.pokemontcg.io/v2/cards?q=%21name%3Acharizard%20subtypes%3Amega%20-types%3Afire&page=1&pageSize=250&orderBy='
                && $request->method() === 'GET';
        });

        CardFacade::search('!name:charizard subtypes:mega -types:fire', 1, 237);

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

    public function testStaticSetEndpoints(): void
    {
        SetFacade::find('random-set');

        Http::assertSent(function (Request $request) {
            return $request->url() === 'https://api.pokemontcg.io/v2/sets/random-set'
                && $request->method() === 'GET';
        });

        SetFacade::search('legalities.standard:legal');

        Http::assertSent(function (Request $request) {
            return $request->url() === 'https://api.pokemontcg.io/v2/sets?q=legalities.standard%3Alegal&page=1&pageSize=250&orderBy='
                && $request->method() === 'GET';
        });

        SetFacade::search('legalities.standard:legal', 1, 'max');

        Http::assertSent(function (Request $request) {
            return $request->url() === 'https://api.pokemontcg.io/v2/sets?q=legalities.standard%3Alegal&page=1&pageSize=250&orderBy='
                && $request->method() === 'GET';
        });

        SetFacade::search('legalities.standard:legal', 1, 237);

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

    public function testStaticSupertypeEndpoints(): void
    {
        SupertypeFacade::all();

        Http::assertSent(function (Request $request) {
            return $request->url() === 'https://api.pokemontcg.io/v2/supertypes'
                && $request->method() === 'GET';
        });
    }

    public function testSubtypeEndpoints(): void
    {
        $subtypes = Pokemontcg::subtypes();

        $subtypes->all();

        Http::assertSent(function (Request $request) {
            return $request->url() === 'https://api.pokemontcg.io/v2/subtypes'
                && $request->method() === 'GET';
        });
    }

    public function testStaticSubtypeEndpoints(): void
    {
        SubtypeFacade::all();

        Http::assertSent(function (Request $request) {
            return $request->url() === 'https://api.pokemontcg.io/v2/subtypes'
                && $request->method() === 'GET';
        });
    }

    public function testTypeEndpoints(): void
    {
        $types = Pokemontcg::types();

        $types->all();

        Http::assertSent(function (Request $request) {
            return $request->url() === 'https://api.pokemontcg.io/v2/types'
                && $request->method() === 'GET';
        });
    }

    public function testStaticTypeEndpoints(): void
    {
        TypeFacade::all();

        Http::assertSent(function (Request $request) {
            return $request->url() === 'https://api.pokemontcg.io/v2/types'
                && $request->method() === 'GET';
        });
    }

    public function testRarityEndpoints(): void
    {
        $rarities = Pokemontcg::rarities();

        $rarities->all();

        Http::assertSent(function (Request $request) {
            return $request->url() === 'https://api.pokemontcg.io/v2/rarities'
                && $request->method() === 'GET';
        });
    }

    public function testStaticRarityEndpoints(): void
    {
        RarityFacade::all();

        Http::assertSent(function (Request $request) {
            return $request->url() === 'https://api.pokemontcg.io/v2/rarities'
                && $request->method() === 'GET';
        });
    }
}
