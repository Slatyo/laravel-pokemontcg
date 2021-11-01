<?php

namespace Slatyo\LaravelPokemontcg\Models;

class Supertype extends Model
{
    /**
     * @return mixed
     */
    public function all(): mixed
    {
        return $this->resolveResponse($this->client->get($this->getEndpoint()), $this->getEndpoint());
    }
}
