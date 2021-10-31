<?php

namespace Slaty\LaravelPokemontcg\Models;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

abstract class Model
{
    /**
     * @var PendingRequest
     */
    protected PendingRequest $client;

    /**
     * @var string $endpoint
     */
    protected string $endpoint;

    /**
     *
     */
    public function __construct()
    {
        $this->client = Http::withOptions(
            [
                'base_uri' => config('pokemontcg.api_url', 'https://api.pokemontcg.io/v2'),
            ]
        )->withHeaders(
            [
                'X-Api-Key' => config('pokemontcg.secret'),
            ]
        );

        $this->setEndpoint();
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

    protected function setEndpoint(): void
    {
        $this->endpoint = Str::kebab(Str::plural(class_basename(get_class($this))));
    }

    protected function getEndpoint(): string
    {
        return $this->endpoint;
    }
}
