<?php

namespace Tests\Unit\Support;

use App\Enums\HttpMethod;
use App\Support\ApiClient;
use App\Support\ApiRequest;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class ApiClientTest extends TestCase
{
    private $client;

    protected function setUp(): void
    {
        parent::setUp();

        Http::fake();

        $this->client = new class extends ApiClient
        {
            protected function baseUrl(): string
            {
                return 'https://example.com';
            }
        };
    }

    public function testSendsAGetRequest(): void
    {
        $request = ApiRequest::get('foo')
            ->setHeaders(['X-Foo' => 'Bar'])
            ->setQuery(['baz' => 'qux']);

        $this->client->send($request);

        Http::assertSent(static function (Request $request) {
            return $request->url() === 'https://example.com/foo?baz=qux'
                && $request->method() === HttpMethod::GET->name
                && $request->header('X-Foo') === ['Bar'];
        });
    }

    public function testSendsAPostRequest(): void
    {
        $request = ApiRequest::post('foo')
            ->setBody(['foo' => 'bar'])
            ->setHeaders(['X-Foo' => 'Bar'])
            ->setQuery(['baz' => 'qux']);

        $this->client->send($request);

        Http::assertSent(static function (Request $request) {
            return $request->url() === 'https://example.com/foo?baz=qux'
                && $request->method() === HttpMethod::POST->name
                && $request->data() === ['foo' => 'bar']
                && $request->header('X-Foo') === ['Bar'];
        });
    }

    public function testSendsAPutRequest(): void
    {
        $request = ApiRequest::put('foo')
            ->setBody(['foo' => 'bar'])
            ->setHeaders(['X-Foo' => 'Bar'])
            ->setQuery(['baz' => 'qux']);

        $this->client->send($request);

        Http::assertSent(static function (Request $request) {
            return $request->url() === 'https://example.com/foo?baz=qux'
                && $request->method() === HttpMethod::PUT->name
                && $request->data() === ['foo' => 'bar']
                && $request->header('X-Foo') === ['Bar'];
        });
    }

    public function testSendsADeleteRequest(): void
    {
        $request = ApiRequest::delete('foo')
            ->setBody(['foo' => 'bar'])
            ->setHeaders(['X-Foo' => 'Bar'])
            ->setQuery(['baz' => 'qux']);

        $this->client->send($request);

        Http::assertSent(static function (Request $request) {
            return $request->url() === 'https://example.com/foo?baz=qux'
                && $request->method() === HttpMethod::DELETE->name
                && $request->data() === ['foo' => 'bar']
                && $request->header('X-Foo') === ['Bar'];
        });
    }

    public function testHandlesAuthorization(): void
    {
        $client = new class extends ApiClient
        {
            protected function baseUrl(): string
            {
                return 'https://example.com';
            }

            protected function authorize(PendingRequest $request): PendingRequest
            {
                return $request->withHeaders(['Authorization' => 'Bearer foo']);
            }
        };

        $request = ApiRequest::get('foo');

        $client->send($request);

        Http::assertSent(static function (Request $request) {
            return $request->header('Authorization') === ['Bearer foo'];
        });
    }
}
