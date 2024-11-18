<?php

namespace App\Actions\Systems;

use App\Support\ApiRequest;
use App\Support\SpaceTradersApiClient;
use App\Support\Waypoint;

class GetConstructionSite
{

    /**
     * @throws \Throwable
     */
    public function __invoke(Waypoint $waypoint)
    {
        if (empty($waypoint->system) || empty($waypoint->waypoint)) {
            throw new \InvalidArgumentException('Invalid waypoint');
        }

        $client = app(SpaceTradersApiClient::class);

        $request =
            ApiRequest::get('/systems/' . $waypoint->system . '/waypoints/' . $waypoint->waypoint . '/construction');

        return $client->send($request);
    }

}
