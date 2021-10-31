<?php

namespace Slatyo\LaravelPokemontcg\Tests;

use ReflectionException;
use Slatyo\LaravelPokemontcg\Models\Card;
use Slatyo\LaravelPokemontcg\Pokemontcg;

class ModelTest extends TestCase
{
    /**
     * @throws ReflectionException
     */
    public function testEndpointMethods(): void
    {
        $cards = Pokemontcg::cards();
        $this->invokeMethod($cards, 'setEndpoint');

        $endpoint = $this->invokeMethod($cards, 'getEndpoint');
        $this->assertEquals('cards', $endpoint);

        $sets = Pokemontcg::sets();
        $this->invokeMethod($sets, 'setEndpoint');

        $endpoint = $this->invokeMethod($sets, 'getEndpoint');
        $this->assertEquals('sets', $endpoint);

        $supertypes = Pokemontcg::supertypes();
        $this->invokeMethod($supertypes, 'setEndpoint');

        $endpoint = $this->invokeMethod($supertypes, 'getEndpoint');
        $this->assertEquals('supertypes', $endpoint);

        $subtypes = Pokemontcg::subtypes();
        $this->invokeMethod($subtypes, 'setEndpoint');

        $endpoint = $this->invokeMethod($subtypes, 'getEndpoint');
        $this->assertEquals('subtypes', $endpoint);

        $types = Pokemontcg::types();
        $this->invokeMethod($types, 'setEndpoint');

        $endpoint = $this->invokeMethod($types, 'getEndpoint');
        $this->assertEquals('types', $endpoint);

        $rarities = Pokemontcg::rarities();
        $this->invokeMethod($rarities, 'setEndpoint');

        $endpoint = $this->invokeMethod($rarities, 'getEndpoint');
        $this->assertEquals('rarities', $endpoint);
    }
}