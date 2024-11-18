<?php

namespace App\Actions\Agents;

use App\Support\ApiRequest;
use App\Support\SpaceTradersApiClient;

class ListAgents
{

    public function __invoke(int $limit = 10, int $page = 1)
    {
        $client = app(SpaceTradersApiClient::class);

        $request = ApiRequest::get('agents')
            ->setQuery('limit', $limit)
            ->setQuery('page', $page);

        return $client->send($request);
    }

}
