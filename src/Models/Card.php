<?php

namespace Slatyo\LaravelPokemontcg\Models;

class Card extends Model
{
    /**
     * Maximum allowed entries per page
     */
    public const MAXIMUM_PAGE_SIZE = 250;

    /**
     * @param  string  $pokemonTcgId
     *
     * @return mixed
     */
    public function find(string $pokemonTcgId): mixed
    {
        return $this->resolveResponse(
            $this->client->get($this->getEndpoint(), [
                'id' => $pokemonTcgId,
            ]),
            $this->getEndpoint().$pokemonTcgId
        );
    }

    /**
     * @param  string      $query
     * @param  int         $page
     * @param  int|string  $pageSize
     * @param  string      $orderBy
     *
     * @return mixed
     */
    public function search(
        string $query,
        int $page = 1,
        int|string $pageSize = self::MAXIMUM_PAGE_SIZE,
        string $orderBy = ''
    ): mixed {
        if ($pageSize > 250 || $pageSize === 'max') {
            $pageSize = self::MAXIMUM_PAGE_SIZE;
        }

        return $this->resolveResponse(
            $this->client->get($this->getEndpoint(), [
                'q' => $query,
                'page' => $page,
                'pageSize' => $pageSize,
                'orderBy' => $orderBy,
            ]),
            $this->getEndpoint().$query
        );
    }

    /**
     * @param  string  $pokemon
     * @param  bool    $strict
     *
     * @return mixed
     */
    public function name(string $pokemon, bool $strict = false): mixed
    {
        $exclamation = '';

        if ($strict) {
            $exclamation = '!';
        }

        return $this->resolveResponse(
            $this->client->get($this->getEndpoint(), [
                'q' => $exclamation.'name:'.$pokemon,
            ]),
            $this->getEndpoint().$pokemon
        );
    }

    /**
     * @param  string  $pokemon
     * @param  bool    $strict
     *
     * @return mixed
     */
    public function whereName(string $pokemon, bool $strict = false): mixed
    {
        return $this->name($pokemon, $strict);
    }

    /**
     * @param  string  $supertype
     * @param  string  $type
     *
     * @return mixed
     */
    public function supertype(string $supertype, string $type = ''): mixed
    {
        if ($type !== '') {
            $type = ' -types:'.$type;
        }

        return $this->resolveResponse(
            $this->client->get($this->getEndpoint(), [
                'q' => 'name:'.$supertype.$type,
            ]),
            $this->getEndpoint().$supertype.$type
        );
    }

    /**
     * @param  string  $supertype
     * @param  string  $type
     *
     * @return mixed
     */
    public function whereSupertype(string $supertype, string $type = ''): mixed
    {
        return $this->supertype($supertype, $type);
    }

    /**
     * @param  string  $from
     * @param  string  $to
     *
     * @return mixed
     */
    public function pokedex(string $from, string $to): mixed
    {
        return $this->resolveResponse(
            $this->client->get($this->getEndpoint(), [
                'q' => 'nationalPokedexNumbers:['.$from.' TO '.$to.']',
            ]),
            $this->getEndpoint().'nationalPokedex'.$from.$to
        );
    }

    /**
     * @param  string  $from
     * @param  string  $to
     *
     * @return mixed
     */
    public function wherePokedex(string $from, string $to): mixed
    {
        return $this->pokedex($from, $to);
    }

    /**
     * @param  string  $from
     * @param  string  $to
     *
     * @return mixed
     */
    public function hp(string $from, string $to): mixed
    {
        return $this->resolveResponse(
            $this->client->get($this->getEndpoint(), [
                'q' => 'hp:['.$from.' TO '.$to.']',
            ]),
            $this->getEndpoint().'hp'.$from.$to
        );
    }

    /**
     * @param  string  $from
     * @param  string  $to
     *
     * @return mixed
     */
    public function whereHp(string $from, string $to): mixed
    {
        return $this->hp($from, $to);
    }
}
