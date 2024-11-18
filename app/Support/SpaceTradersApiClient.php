<?php

namespace App\Support;

use Illuminate\Http\Client\PendingRequest;

class SpaceTradersApiClient extends ApiClient
{

    protected function baseUrl(): string
    {
        return config('services.space_traders.base_url');
    }

    protected function authorize(PendingRequest $request): PendingRequest
    {
        return $request->withToken(config('services.space_traders.token'));
    }

}
