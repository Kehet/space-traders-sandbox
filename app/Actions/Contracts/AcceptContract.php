<?php

namespace App\Actions\Contracts;

use App\Support\ApiRequest;
use App\Support\SpaceTradersApiClient;

class AcceptContract
{

    public function __invoke(string $contractId)
    {
        $client = app(SpaceTradersApiClient::class);

        $request = ApiRequest::post('my/contracts/' . $contractId . '/accept');

        return $client->send($request);
    }

}
