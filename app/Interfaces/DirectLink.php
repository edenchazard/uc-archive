<?php

namespace App\Interfaces;

use Illuminate\Database\Eloquent\Casts\Attribute;

interface DirectLink
{
    /**
     * @return Attribute<string|null,never>
     */
    public function directLink(): Attribute;
}
