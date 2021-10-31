<?php

namespace Slatyo\LaravelPokemontcg\Tests;

use Illuminate\Support\Facades\Http;
use Orchestra\Testbench\TestCase as Orchestra;
use ReflectionException;

class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();

        Http::fake([
            '*' => Http::response(),
        ]);
    }

    /**
     * Call protected/private method of a class
     *
     * @param  object  $object
     * @param  string  $methodName
     * @param  array   $parameters
     *
     * @return mixed
     * @throws ReflectionException
     */
    public function invokeMethod(object $object, string $methodName, array $parameters = []): mixed
    {
        $reflection = new \ReflectionClass(get_class($object));
        $method = $reflection->getMethod($methodName);
        $method->setAccessible(true);

        return $method->invokeArgs($object, $parameters);
    }
}
