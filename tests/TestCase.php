<?php

namespace Slaty\LaravelPokemontcg\Tests;

use Illuminate\Support\Facades\Http;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();

        Http::fake([
            '*' => Http::response(),
        ]);
    }
}
