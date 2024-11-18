<?php

namespace App\Console\Commands;

use App\Actions\Systems\GetWaypoint;
use App\Support\Waypoint;
use Illuminate\Console\Command;

class GetWaypointCommand extends Command
{

    protected $signature = 'st:waypoint';

    protected $description = '';

    /**
     * @throws \Throwable
     */
    public function handle(): void
    {
        $waypoint = Waypoint::from($this->ask('Enter Waypoint'));

        $response = app(GetWaypoint::class)($waypoint);

        dump($response->json());
    }

}
