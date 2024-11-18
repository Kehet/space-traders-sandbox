<?php

namespace App\Console\Commands;

use App\Actions\Agents\GetAgent;
use Illuminate\Console\Command;

class GetAgentCommand extends Command
{
    protected $signature = 'st:agent';

    protected $description = '';

    public function handle(): void
    {
        $response = app(GetAgent::class)();

        dump($response->json());
    }
}
