<?php

namespace Slaty\LaravelPokemontcg\Models;

class Type extends Model
{
    /**
     * @var string
     */
    public const ENDPOINT = '/types';

    /**
     * @return mixed
     */
    public function all(): mixed
    {
        return $this->resolveResponse($this->client->get(self::ENDPOINT), self::ENDPOINT);
    }
}