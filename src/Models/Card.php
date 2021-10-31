<?php

namespace Slaty\LaravelPokemontcg\Models;

class Card extends Model
{
    /**
     * Maximum allowed entries per page
     */
    public const MAXIMUM_PAGE_SIZE = 250;

    /**
     * @var string
     */
    public const ENDPOINT = '/cards';

    /**
     * @param  string  $pokemonTcgId
     *
     * @return mixed
     */
    public function find(string $pokemonTcgId): mixed
    {
        return $this->resolveResponse(
            $this->client->get(self::ENDPOINT, [
                'id' => $pokemonTcgId,
            ]),
            self::ENDPOINT.$pokemonTcgId
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
            $this->client->get(self::ENDPOINT, [
                'q' => $query,
                'page' => $page,
                'pageSize' => $pageSize,
                'orderBy' => $orderBy,
            ]),
            self::ENDPOINT.$query
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
            $this->client->get(self::ENDPOINT, [
                'q' => $exclamation.'name:'.$pokemon,
            ]),
            self::ENDPOINT.$pokemon
        );
    }

    /**
     * @param  string  $supertype
     * @param  string  $type
     *
     * @return mixed
     */
    public function supertype(string $supertype, string $type = ''): mixed
    {
        if (strlen($type)) {
            $type = ' -types:'.$type;
        }
        return $this->resolveResponse(
            $this->client->get(self::ENDPOINT, [
                'q' => 'name:'.$supertype.$type,
            ]),
            self::ENDPOINT.$supertype.$type
        );
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
            $this->client->get(self::ENDPOINT, [
                'q' => 'nationalPokedexNumbers:['.$from.' TO '.$to.']',
            ]),
            self::ENDPOINT.'nationalPokedex'.$from.$to
        );
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
            $this->client->get(self::ENDPOINT, [
                'q' => 'hp:['.$from.' TO '.$to.']',
            ]),
            self::ENDPOINT.'hp'.$from.$to
        );
    }
}