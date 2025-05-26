<?php

namespace App\Enums;

use Str;

enum SpecialtyEnum: int
{
    case None = 0;
    case Noble = 1;
    case Exalted = 2;
    case Exotic = 3;
    case Legendary = 4;

    public function friendlyName(): string
    {
        return Str::lower($this->name);
    }
}
