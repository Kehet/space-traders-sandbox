<?php

namespace App\Console\Commands;

use App\Actions\Status;
use Illuminate\Console\Command;

class StatusCommand extends Command
{
    protected $signature = 'st:status';

    protected $description = '';

    public function handle(): void
    {
        $response = app(Status::class)();

        dump($response->json());
    }
}
