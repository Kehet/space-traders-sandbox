<?php

namespace App\Console\Commands;

use App\Actions\Fleet\ListShips;
use Illuminate\Console\Command;

class ListShipsCommand extends Command
{
    protected $signature = 'st:ships-list';

    protected $description = '';

    public function handle(): void
    {
        $response = app(ListShips::class)();

        dump($response->json());
    }
}
