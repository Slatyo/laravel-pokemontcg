<?php

namespace Slaty\LaravelPokemontcg\Models;

class Supertype extends Model
{
    /**
     * @var string
     */
    public const ENDPOINT = '/supertypes';

    /**
     * @return mixed
     */
    public function all(): mixed
    {
        return $this->resolveResponse($this->client->get(self::ENDPOINT), self::ENDPOINT);
    }
}