<?php

declare(strict_types=1);

namespace App\Services\Creatures;

use App\Models\UserPet;

/**
 * Mainly for translating various database values for creatures
 * and families into their string names.
 */
class CreatureUtils
{
    /**
     * @var array<int, string>
     */
    protected const stats = [
        'strength',
        'agility',
        'speed',
        'intelligence',
        'wisdom',
        'charisma',
        'creativity',
        'willpower',
        'focus',
    ];

    /**
     * @var array<int, string>
     */
    protected const specialties = [
        0 => '', //regular
        1 => 'noble',
        2 => 'exalted',
        3 => 'exotic',
        4 => 'legendary',
    ];

    /**
     * Returns a list of possible creature stats used in the application.
     * @return \Illuminate\Support\Collection<int, string>
     */
    public static function getPossibleStats()
    {
        return static::getMapping(static::stats);
    }

    /**
     * Translates an integer gender and returns the friendly name.
     * @param int $val
     * The gender as a number.
     * Special case: If 3 (both) is passed, "both" will be returned.
     */
    public static function gender(int $val): string
    {
        // 3 (Both is a special case)
        return strtolower(
            $val === CreatureGender::both ? 'both' : CreatureGender::get($val)->friendlyName()
        );
    }

    /**
     * Translates a specialty rating from number to string.
     * @param int $val The specialty rating as a number.
     */
    public static function specialty(int $val): string
    {
        return static::getMapping(static::specialties, $val);
    }

    /**
     * Returns yes or no as to if the creature has basket availability.
     */
    public static function basket(int|bool $val): string
    {
        return $val ? 'Yes' : 'No';
    }

    /**
     * Returns yes or no as to if the creature can be exalted or nobled.
     */
    public static function canExaltNoble(int|bool $val): string
    {
        return ! $val ? 'Yes' : 'No';
    }

    /**
     * Constructs an image url for a given pet.
     * @param UserPet $pet The pet to make an image url from.
     */
    public static function imageLink(UserPet $pet): string
    {
        $creature = &$pet->creature;
        $parts = collect([]);

        if ($pet->specialty > 0 && $pet->specialty <= 2) {
            $parts->push(static::specialty($pet->specialty));
        }

        if ($pet->variety) {
            $parts->push($pet->variety);
        }

        // creatures with their family name don't follow the same url format...
        $parts->push($creature->family->name);

        if ($creature->family->name !== $creature->name) {
            $parts->push($creature->name);
        }

        $path = strtolower("/images/creatures/{$creature->family->name}/{$parts->join('_')}.png");

        return asset($path);
    }

    /**
     * returns the mapping as a collection.
     * @param array $dictionary The array to search.
     * @param int $index the index to return. If null, returns the array itself.
     * @return string|\Illuminate\Support\Collection<int, string>
     */
    protected static function getMapping(array $dictionary, int $index = null)
    {
        // check dictionary exists
        if ($index === null) {
            /*  if (!property_exists(static::class, $dictionary))
                throw new Exception("$dictionary not found."); */

            return collect($dictionary);
        }
        // check index in dictionary exists
        /*      if (!isset(static::$$dictionary[$index]))
            throw new Exception("$index not found in $dictionary"); */

        return $dictionary[$index];

    }
}
