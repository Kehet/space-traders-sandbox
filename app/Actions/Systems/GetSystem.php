<?php

namespace App\Actions\Systems;

use App\Support\ApiRequest;
use App\Support\SpaceTradersApiClient;
use App\Support\Waypoint;

class GetSystem
{

    /**
     * @throws \Throwable
     */
    public function __invoke(Waypoint $waypoint)
    {
        if (empty($waypoint->system)) {
            throw new \InvalidArgumentException('Invalid waypoint');
        }

        $client = app(SpaceTradersApiClient::class);

        $request = ApiRequest::get('/systems/' . $waypoint->system);

        return $client->send($request);
    }

}
