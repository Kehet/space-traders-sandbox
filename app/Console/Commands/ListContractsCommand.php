<?php

namespace App\Console\Commands;

use App\Actions\Contracts\ListContracts;
use Illuminate\Console\Command;

class ListContractsCommand extends Command
{
    protected $signature = 'st:contracts';

    protected $description = '';

    public function handle(): void
    {
        $response = app(ListContracts::class)();

        dump($response->json());
    }
}
