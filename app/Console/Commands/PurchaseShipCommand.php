<?php

namespace App\Console\Commands;

use App\Actions\Fleet\PurchaseShip;
use App\Enums\ShipType;
use App\Support\Waypoint;
use Illuminate\Console\Command;

class PurchaseShipCommand extends Command
{
    protected $signature = 'st:ship-purchase';

    protected $description = '';

    public function handle(): void
    {
        $waypoint = Waypoint::from($this->ask('Enter Waypoint'));

        $type = ShipType::from(
            $this->choice(
                'Select Type',
                collect(ShipType::cases())->map(fn($symbol) => $symbol->value)->toArray(),
            )
        );

        $response = app(PurchaseShip::class)($type, $waypoint);

        dump($response->json());
    }
}
