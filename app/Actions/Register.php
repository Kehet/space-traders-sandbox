<?php

namespace App\Actions;

use App\Enums\FactionSymbol;
use App\Support\ApiRequest;
use App\Support\SpaceTradersApiClient;
use Illuminate\Http\Client\Response;

class Register
{

    public function __invoke(string $callSign, FactionSymbol $faction): Response
    {
        $client = app(SpaceTradersApiClient::class);

        $request = ApiRequest::post('register')
            ->setBody('symbol', $callSign)
            ->setBody('faction', $faction->name);

        return $client->send($request);
    }

}
