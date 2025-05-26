<?php

declare(strict_types=1);

namespace App\Services\Creatures;

/**
 * Mainly for translating various database values for creatures
 * and families into their string names.
 */
class CreatureUtils
{
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
