<?php

namespace App\Console\Commands;

use App\Actions\Register;
use App\Enums\FactionSymbol;
use Illuminate\Console\Command;

class RegisterCommand extends Command
{

    protected $signature = 'st:register';

    protected $description = '';

    public function handle(): void
    {
        $name = $this->ask('Call Sign');
        $faction =
            FactionSymbol::from($this->choice('Faction', collect(FactionSymbol::cases())->map->value->toArray()));

        $response = app(Register::class)($name, $faction);

        dump($response->json());
    }

}
