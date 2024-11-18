<?php

namespace App\Actions\Agents;

use App\Support\ApiRequest;
use App\Support\SpaceTradersApiClient;

class GetPublicAgent
{

    public function __invoke(string $agentSymbol)
    {
        $client = app(SpaceTradersApiClient::class);

        $request = ApiRequest::get('agents/' . $agentSymbol);

        return $client->send($request);
    }

}
