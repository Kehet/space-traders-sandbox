<?php

namespace App\Console\Commands;

use App\Actions\Systems\ListWaypoints;
use App\Enums\WaypointTraitSymbol;
use App\Enums\WaypointType;
use App\Support\Waypoint;
use Illuminate\Console\Command;

class ListWaypointsCommand extends Command
{
    protected $signature = 'st:waypoints';

    protected $description = '';

    /**
     * @throws \Throwable
     */
    public function handle(): void
    {
        $waypoint = Waypoint::from($this->ask('Enter System'));

        if ($this->confirm('Select traits?')) {
            $traits = collect(
                $this->choice(
                    'Select Traits',
                    collect(WaypointTraitSymbol::cases())->map(fn($symbol) => $symbol->value)->toArray(),
                    multiple: true
                )
            )
                ->map(fn($symbol) => WaypointTraitSymbol::from($symbol))
                ->toArray();
        }

        if ($this->confirm('Select type?')) {
            $type = WaypointType::from(
                $this->choice(
                    'Select Type',
                    collect(WaypointType::cases())->map(fn($symbol) => $symbol->value)->toArray(),
                )
            );
        }

        $response = app(ListWaypoints::class)($waypoint, $traits ?? null, $type ?? null);

        dump($response->json());
    }
}
