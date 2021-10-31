<?php

namespace Slatyo\LaravelPokemontcg\Models;

class Type extends Model
{
    /**
     * @return mixed
     */
    public function all(): mixed
    {
        return $this->resolveResponse($this->client->get($this->getEndpoint()), $this->getEndpoint());
    }
}
