<?php

namespace App\Actions\Agents;

use App\Support\ApiRequest;
use App\Support\SpaceTradersApiClient;

class GetAgent
{

    public function __invoke()
    {
        $client = app(SpaceTradersApiClient::class);

        $request = ApiRequest::get('my/agent');

        return $client->send($request);
    }

}
