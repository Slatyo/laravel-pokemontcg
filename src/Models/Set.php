<?php

namespace Slaty\LaravelPokemontcg\Models;

class Set extends Model
{
    /**
     * Maximum allowed entries per page
     */
    public const MAXIMUM_PAGE_SIZE = 250;

    /**
     * @param  string  $set
     *
     * @return mixed
     */
    public function find(string $set): mixed
    {
        $endpoint = $this->getEndpoint().'/'.$set;

        return $this->resolveResponse($this->client->get($endpoint), $endpoint);
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
            $this->getEndpoint()
        );
    }
}
