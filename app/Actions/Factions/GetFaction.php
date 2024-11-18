<?php

namespace App\Actions\Factions;

use App\Support\ApiRequest;
use App\Support\SpaceTradersApiClient;

class GetFaction
{

    public function __invoke(int $limit = 10, int $page = 1)
    {
        $client = app(SpaceTradersApiClient::class);

        $request = ApiRequest::get('factions')
            ->setQuery('limit', $limit)
            ->setQuery('page', $page);

        return $client->send($request);
    }

}
