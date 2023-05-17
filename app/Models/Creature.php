<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Services\Creatures\CreatureUtils;
use DB;

/**
 * App\Models\Creature
 *
 * @property int $id
 * @property string $name
 * @property int $stage
 * @property string $short_description
 * @property string $long_description
 * @property int $required_clicks
 * @property int $max_strength
 * @property int $max_agility
 * @property int $max_speed
 * @property int $max_intelligence
 * @property int $max_wisdom
 * @property int $max_charisma
 * @property int $max_creativity
 * @property int $max_willpower
 * @property int $max_focus
 * @property int $family_id
 * @property int $component_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Consumable|null $consumable
 * @property-read \App\Models\Family|null $family
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\TrainingOption> $trainingOptions
 * @property-read int|null $training_options_count
 * @method static \Illuminate\Database\Eloquent\Builder|Creature locate(string|int $family, string|int $creature)
 * @method static \Illuminate\Database\Eloquent\Builder|Creature newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Creature newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Creature query()
 * @method static \Illuminate\Database\Eloquent\Builder|Creature whereComponentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Creature whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Creature whereFamilyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Creature whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Creature whereLongDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Creature whereMaxAgility($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Creature whereMaxCharisma($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Creature whereMaxCreativity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Creature whereMaxFocus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Creature whereMaxIntelligence($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Creature whereMaxSpeed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Creature whereMaxStrength($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Creature whereMaxWillpower($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Creature whereMaxWisdom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Creature whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Creature whereRequiredClicks($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Creature whereShortDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Creature whereStage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Creature whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Creature extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $fillable = ['alts'];

    public function family(): BelongsTo
    {
        return $this->belongsTo(Family::class);
    }

    public function consumable(): HasOne
    {
        return $this->hasOne(Consumable::class, 'id', 'component_id');
    }

    public function trainingOptions(): HasMany
    {
        return $this->hasMany(TrainingOption::class);
    }

    /**
     * Finds a creature by resolving family and creature name.
     * 
     * If you want to resolve by creature id, you should use ::find instead.
     *
     * @param family string|int If a string is provided, the family name will be 
     * inferred. If an integer is provided, it was assume that is the family id.
     * @param creature string|int If a string is provided, it will be assumed to be the
     * creature's name. A number will be inferred as the stage in the family.
     */
    public function scopeLocate($query, string|int $family, string|int $creature)
    {
        $familyId = null;

        if (gettype($family) === 'string')
            $family = Family::findByName($family);

        if (!$family) return null;

        $familyId = $family->id;

        // get creature
        $conditions = [
            'family_id' => $familyId
        ];

        $conditions[gettype($creature) === 'int' ? 'stage' : 'name'] = $creature;
        $query->where($conditions);
    }

    /**
     * Wrap the creature around a fake User Pet container
     * and set its creature relation to this instance.
     * @param string[] $attrs Attributes to inject.
     * @return UserPet
     */
    public function wrap(array $attrs = []): UserPet
    {
        return (new UserPet([
            'specialty' => 0,
            'variety' => 0,
            'creature_id' => $this->id,
            'nickname' => $this->name,
            ...$attrs
        ]))->setRelation('creature', $this);
    }

    /**
     * Calculate the max possible stat value for this creature.
     * @return int
     */
    public function getMaxStats(): int
    {
        return $this->getStats()->sum();
    }

    /**
     * Get all stats in a single collection.
     * @return \Illuminate\Database\Eloquent\Collection<string, int>
     */
    public function getStats()
    {
        return CreatureUtils::getPossibleStats()->flip()->map(fn ($val, $key) => $this["max_$key"]);
    }

    /**
     * Returns the nearest previous and nearest next creatures adjacent to this
     * creature in terms of id. Skips missing ids.
     * @return \Illuminate\Database\Eloquent\Collection<string, Creature>
     */
    public function getAdjacentIds()
    {
        $adjacent =
            fn (string $operator, string $order) =>
            DB::table($this->table)
                ->select('id')
                ->where('id', $operator, $this->id)
                ->orderBy('id', $order)
                ->limit(1);

        // get the highest max id before this id (previous)
        // and the lowest max id after this id (next) 
        $adjacents = DB::query()
            ->selectSub($adjacent('<', 'desc'), 'previous')
            ->selectSub($adjacent('>', 'asc'), 'next')
            ->first();

        $creatures = Creature::with('family')->find([
            $adjacents->previous,
            $adjacents->next
        ]);

        // matches the ids up to what we got earlier,
        // if there is no previous or next, null will be returned. 
        return collect([
            'previous' => $creatures->find($adjacents->previous),
            'next' => $creatures->find($adjacents->next),
        ]);
    }

    public function scopeJoinFamily($query, bool $selectFamilyTable = false)
    {
        $familyTable = (new Family)->getTable();
        $creatureTable = (new static)->getTable();

        $query = $query->join($familyTable, "$familyTable.id", '=', "$creatureTable.family_id");
        if (!$selectFamilyTable) $query = $query->addSelect("$creatureTable.*");
        return $query;
    }

    public function scopeOrderByFamilyName($query)
    {
        $familyTable = (new Family)->getTable();
        return $query->orderBy("$familyTable.name");
    }
}
