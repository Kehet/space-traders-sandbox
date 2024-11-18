<?php

namespace App\Actions\Contracts;

use App\Support\ApiRequest;
use App\Support\SpaceTradersApiClient;

class ListContracts
{

    public function __invoke(int $limit = 10, int $page = 1)
    {
        $client = app(SpaceTradersApiClient::class);

        $request = ApiRequest::get('my/contracts')
            ->setQuery('limit', $limit)
            ->setQuery('page', $page);

        return $client->send($request);
    }

}
