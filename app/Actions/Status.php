<?php

namespace App\Actions;

use App\Support\ApiRequest;
use App\Support\SpaceTradersApiClient;

class Status
{

    public function __invoke()
    {
        $client = app(SpaceTradersApiClient::class);

        $request = ApiRequest::get('/');

        return $client->send($request);
    }

}
