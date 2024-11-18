<?php

namespace App\Support;

class Waypoint
{

    public static function from($string): self
    {
        $pieces = explode('-', $string);

        return new self(
            $pieces[0] ?? null,
            isset($pieces[1]) ? $pieces[0] . '-' . $pieces[1] : null,
            isset($pieces[2]) ? $pieces[0] . '-' . $pieces[1] . '-' . $pieces[2] : null,
        );
    }

    public function __construct(
        public ?string $sector = null,
        public ?string $system = null,
        public ?string $waypoint = null,
    ) {
    }

}
