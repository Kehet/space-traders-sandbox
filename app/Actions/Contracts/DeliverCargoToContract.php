<?php

namespace App\Actions\Contracts;

use App\Support\ApiRequest;
use App\Support\SpaceTradersApiClient;

class DeliverCargoToContract
{

    public function __invoke(string $contractId, string $shipSymbol, string $tradeSymbol, int $units)
    {
        $client = app(SpaceTradersApiClient::class);

        $request = ApiRequest::post('my/contracts/' . $contractId . '/deliver')
            ->setBody('shipSymbol', $shipSymbol)
            ->setBody('tradeSymbol', $tradeSymbol)
            ->setBody('units', $units);

        return $client->send($request);
    }

}
