<?php

namespace App\Interfaces;

use Illuminate\Database\Eloquent\Casts\Attribute;

interface ImageLink
{
    /**
     * @return Attribute<string|null,never>
     */
    public function imageLink(): Attribute;
}
