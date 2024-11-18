<?php

namespace App\Console\Commands;

use App\Actions\Contracts\AcceptContract;
use Illuminate\Console\Command;

class AcceptContractCommand extends Command
{
    protected $signature = 'st:contract-accept';

    protected $description = '';

    public function handle(): void
    {
        $contract = $this->ask('Contract ID');

        $response = app(AcceptContract::class)($contract);

        dump($response->json());
    }
}
