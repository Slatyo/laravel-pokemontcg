<?php

namespace Slaty\LaravelPokemontcg\Models;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

abstract class Model
{
    /**
     * @var PendingRequest
     */
    protected PendingRequest $client;

    /**
     *
     */
    public function __construct()
    {
        $this->client = Http::withOptions(
            [
                'base_uri' => config('pokemontcg.api_url'),
            ]
        )->withHeaders(
            [
                'Accept' => 'application/json',
                'X-Api-Key' => config('pokemontcg.secret'),
            ]
        );
    }

    /**
     * @param  Response  $response
     * @param  string|null  $cacheKey
     *
     * @return mixed
     */
    protected function resolveResponse(Response $response, string $cacheKey = null): mixed
    {
        if (!$cacheKey) {
            return $response->json();
        }

        return Cache::remember($cacheKey, 3600, function () use ($response) {
            return $response->json();
        });
    }
}