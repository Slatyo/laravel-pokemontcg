<?php

namespace Slaty\LaravelPokemontcg\Models;

class Rarity extends Model
{
    /**
     * @var string
     */
    public const ENDPOINT = '/rarities';

    /**
     * @return mixed
     */
    public function all(): mixed
    {
        return $this->resolveResponse($this->client->get(self::ENDPOINT), self::ENDPOINT);
    }
}