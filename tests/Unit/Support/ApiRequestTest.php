<?php

namespace Tests\Unit\Support;

use App\Enums\HttpMethod;
use App\Support\ApiRequest;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class ApiRequestTest extends TestCase
{
    public function testSetsRequestDataProperly(): void
    {
        $request = (new ApiRequest(HttpMethod::GET, '/'))
            ->setHeaders(['foo' => 'bar'])
            ->setQuery(['baz' => 'qux'])
            ->setBody(['quux' => 'quuz']);

        $this->assertEquals(['foo' => 'bar'], $request->getHeaders());
        $this->assertEquals(['baz' => 'qux'], $request->getQuery());
        $this->assertEquals(['quux' => 'quuz'], $request->getBody());
        $this->assertEquals(HttpMethod::GET, $request->getMethod());
        $this->assertEquals('/', $request->getUri());
    }

    public function testSetsRequestDataProperlyWithKeyValue(): void
    {
        $request = (new ApiRequest(HttpMethod::GET, '/'))
            ->setHeaders('foo', 'bar')
            ->setQuery('baz', 'qux')
            ->setBody('quux', 'quuz');

        $this->assertEquals(['foo' => 'bar'], $request->getHeaders());
        $this->assertEquals(['baz' => 'qux'], $request->getQuery());
        $this->assertEquals(['quux' => 'quuz'], $request->getBody());
        $this->assertEquals(HttpMethod::GET, $request->getMethod());
        $this->assertEquals('/', $request->getUri());
    }

    public function testClearsRequestDataProperly(): void
    {
        $request = (new ApiRequest(HttpMethod::GET, '/'))
            ->setHeaders(['foo' => 'bar'])
            ->setQuery(['baz' => 'qux'])
            ->setBody(['quux' => 'quuz']);

        $request->clearHeaders()
            ->clearQuery()
            ->clearBody();

        $this->assertEquals([], $request->getHeaders());
        $this->assertEquals([], $request->getQuery());
        $this->assertEquals([], $request->getBody());
        $this->assertEquals('/', $request->getUri());
    }

    public function testClearsRequestDataProperlyWithKey(): void
    {
        $request = (new ApiRequest(HttpMethod::GET, '/'))
            ->setHeaders('foo', 'bar')
            ->setQuery('baz', 'qux')
            ->setBody('quux', 'quuz');

        $request->clearHeaders('foo')
            ->clearQuery('baz')
            ->clearBody('quux');

        $this->assertEquals([], $request->getHeaders());
        $this->assertEquals([], $request->getQuery());
        $this->assertEquals([], $request->getBody());
        $this->assertEquals('/', $request->getUri());
    }

    #[DataProvider('httpMethodProvider')]
    public function testCreatesInstanceWithCorrectMethod(HttpMethod $method): void
    {
        $request = ApiRequest::{$method->value}('/');
        $this->assertEquals($method, $request->getMethod());
    }

    public static function httpMethodProvider(): array
    {
        return [
            [HttpMethod::GET],
            [HttpMethod::POST],
            [HttpMethod::PUT],
            [HttpMethod::DELETE],
        ];
    }
}
