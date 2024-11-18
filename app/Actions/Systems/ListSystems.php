<?php

namespace App\Actions\Systems;

use App\Support\ApiRequest;
use App\Support\SpaceTradersApiClient;

class ListSystems
{

    /**
     * @throws \Throwable
     */
    public function __invoke(int $limit = 10, int $page = 1)
    {
        $client = app(SpaceTradersApiClient::class);

        $request = ApiRequest::get('/systems/')
            ->setQuery('limit', $limit)
            ->setQuery('page', $page);

        return $client->send($request);
    }

}
