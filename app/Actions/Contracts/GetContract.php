<?php

namespace App\Actions\Contracts;

use App\Support\ApiRequest;
use App\Support\SpaceTradersApiClient;

class GetContract
{

    /**
     * @throws \Throwable
     */
    public function __invoke(string $contractId)
    {
        $client = app(SpaceTradersApiClient::class);

        $request = ApiRequest::get('/my/contracts/' . $contractId);

        return $client->send($request);
    }

}
