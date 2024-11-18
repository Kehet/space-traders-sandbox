<?php

namespace App\Actions\Systems;

use App\Enums\WaypointTraitSymbol;
use App\Enums\WaypointType;
use App\Support\ApiRequest;
use App\Support\SpaceTradersApiClient;
use App\Support\Waypoint;

class ListWaypoints
{

    /**
     * @throws \Throwable
     * @var WaypointTraitSymbol|WaypointTraitSymbol[]|null $traits
     */
    public function __invoke(
        Waypoint $waypoint,
        WaypointTraitSymbol|array|null $traits = null,
        ?WaypointType $type = null,
        int $limit = 10,
        int $page = 1,
    ) {
        if (empty($waypoint->system)) {
            throw new \InvalidArgumentException('Invalid waypoint');
        }

        $client = app(SpaceTradersApiClient::class);

        $request = ApiRequest::get('/systems/' . $waypoint->system . '/waypoints')
            ->setQuery('limit', $limit)
            ->setQuery('page', $page);

        if ($traits !== null) {
            $request->setQuery(
                'traits',
                is_array($traits) ? collect($traits)->map->value->implode(',') : $traits->value
            );
        }

        if ($type !== null) {
            $request->setQuery('type', $type->value);
        }

        return $client->send($request);
    }

}
