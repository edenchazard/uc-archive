<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;

/**
 *  @property EloquentCollection $stages
 */
class Family extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function stages(): HasMany
    {
        return $this->hasMany(Creature::class)->orderBy('stage', 'asc');
    }

    /**
     * Return a family by family name
     */
    public static function findByName(string $name): Family
    {
        return Family::firstWhere('name', $name);
    }
}
