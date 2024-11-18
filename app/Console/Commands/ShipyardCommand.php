<?php

namespace App\Console\Commands;

use App\Actions\Systems\GetShipyard;
use App\Support\Waypoint;
use Illuminate\Console\Command;

class ShipyardCommand extends Command
{
    protected $signature = 'st:shipyard';

    protected $description = '';

    /**
     * @throws \Throwable
     */
    public function handle(): void
    {
        $waypoint = Waypoint::from($this->ask('Enter Waypoint'));

        $response = app(GetShipyard::class)($waypoint);

        dump($response->json());
    }
}
