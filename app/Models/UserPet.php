<?php

namespace App\Models;

use CreatureUtils;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class UserPet extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function creature(): HasOne
    {
        return $this->hasOne(Creature::class);
    }

    public function imageLink(): string
    {
        return CreatureUtils::imageLink($this);
    }
}
