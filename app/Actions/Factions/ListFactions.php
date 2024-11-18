<?php

namespace App\Actions\Factions;

use App\Enums\FactionSymbol;
use App\Support\ApiRequest;
use App\Support\SpaceTradersApiClient;

class ListFactions
{

    public function __invoke(FactionSymbol $factionSymbol)
    {
        $client = app(SpaceTradersApiClient::class);

        $request = ApiRequest::get('factions/' . $factionSymbol->value);

        return $client->send($request);
    }

}
