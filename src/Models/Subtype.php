<?php

namespace Slaty\LaravelPokemontcg\Models;

class Subtype extends Model
{
    /**
     * @return mixed
     */
    public function all(): mixed
    {
        return $this->resolveResponse($this->client->get($this->getEndpoint()), $this->getEndpoint());
    }
}
