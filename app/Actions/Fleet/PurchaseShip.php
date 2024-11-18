<?php

namespace App\Actions\Fleet;

use App\Enums\ShipType;
use App\Support\ApiRequest;
use App\Support\SpaceTradersApiClient;
use App\Support\Waypoint;

class PurchaseShip
{

    public function __invoke(ShipType $shipType, Waypoint $waypoint)
    {
        if (empty($waypoint->waypoint)) {
            throw new \InvalidArgumentException('Invalid waypoint');
        }

        $client = app(SpaceTradersApiClient::class);

        $request = ApiRequest::post('my/ships')
            ->setBody('shipType', $shipType->value)
            ->setBody('waypointSymbol', $waypoint->waypoint);

        return $client->send($request);
    }

}
