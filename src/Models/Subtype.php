<?php

namespace Slaty\LaravelPokemontcg\Models;

class Subtype extends Model
{
    /**
     * @var string
     */
    public const ENDPOINT = '/subtypes';

    /**
     * @return mixed
     */
    public function all(): mixed
    {
        return $this->resolveResponse($this->client->get(self::ENDPOINT), self::ENDPOINT);
    }
}