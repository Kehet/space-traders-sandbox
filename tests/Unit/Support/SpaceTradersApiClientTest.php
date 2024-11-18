<?php

namespace Tests\Unit\Support;

use App\Support\ApiRequest;
use App\Support\SpaceTradersApiClient;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\Request;
use Tests\TestCase;

class SpaceTradersApiClientTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        Http::fake();

        config([
            'services.space_traders.base_url' => 'https://example.com',
            'services.space_traders.token'    => 'foo',
        ]);
    }

    public function testSetsTheBaseUrl(): void
    {
        $request = ApiRequest::get('foo');

        app(SpaceTradersApiClient::class)->send($request);

        Http::assertSent(static function (Request $request) {
            return str_starts_with($request->url(), 'https://example.com/foo');
        });
    }

    public function testSetsTheApiKeyAsHeader(): void
    {
        $request = ApiRequest::get('foo');

        app(SpaceTradersApiClient::class)->send($request);

        Http::assertSent(static function (Request $request) {
            return $request->header('Authorization') === ['Bearer foo'];
        });
    }
}
