<?php

namespace App\Actions\Systems;

use App\Support\ApiRequest;
use App\Support\SpaceTradersApiClient;
use App\Support\Waypoint;

class SupplyConstructionSite
{

    /**
     * @throws \Throwable
     */
    public function __invoke(Waypoint $waypoint, string $shipSymbol, string $tradeSymbol, int $units)
    {
        if (empty($waypoint->system) || empty($waypoint->waypoint)) {
            throw new \InvalidArgumentException('Invalid waypoint');
        }

        $client = app(SpaceTradersApiClient::class);

        $request =
            ApiRequest::post(
                '/systems/' . $waypoint->system . '/waypoints/' . $waypoint->waypoint . '/construct/supply'
            )
                ->setBody('shipSymbol', $shipSymbol)
                ->setBody('tradeSymbol', $tradeSymbol)
                ->setBody('units', $units);

        return $client->send($request);
    }

}
