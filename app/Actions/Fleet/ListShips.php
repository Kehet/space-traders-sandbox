<?php

namespace App\Actions\Fleet;

use App\Support\ApiRequest;
use App\Support\SpaceTradersApiClient;

class ListShips
{

    public function __invoke(int $limit = 10, int $page = 1)
    {
        $client = app(SpaceTradersApiClient::class);

        $request = ApiRequest::get('my/ships')
            ->setQuery('limit', $limit)
            ->setQuery('page', $page);

        return $client->send($request);
    }

}
