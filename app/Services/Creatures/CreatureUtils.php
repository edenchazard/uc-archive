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
     * @var array<int, array<string, x>>
     */
    protected const rarities = [
        13 =>  array('WTFBBQ!?', 0),
        12 =>  array('WTF?', 0),
        11 => array('seriously?', 0),
        10 => array('exotic', 1),
        9 => array('epic race', 0),
        8 => array('exclusive', 5),
        7 => array('rare', 2),
        6 => array('limited', 4),
        5 => array('scarce', 6),
        4 => array('uncommon', 10),
        3 => array('common', 20),
        2 => array('plentiful', 26),
        1 => array('abundant', 32),
        0 => ['unknown', 0]
    ];

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
        'focus'
    ];

    /**
     * @var array<int, string>
     */
    protected const specialties =  [
        0 => '', //regular
        1 => 'noble',
        2 => 'exalted',
        3 => 'exotic',
        4 => 'legendary'
    ];

    /**
     * @var array<int, string>
     */
    protected const elements = [
        1 => 'earth',
        2 => 'air',
        3 => 'spirit',
        4 => 'water',
        5 => 'fire',
        6 => 'physical',
        7 => 'unique',
        8 => 'grass',
        9 => 'sweet',
        10 => 'metal',
        11 => 'deity',
        12 => 'moon',
        13 => 'dream',
        14 => 'luck',
        15 => 'shimmer',
        16 => 'awesomeness',
        17 => 'tree',
        18 => 'sparkly',
        19 => 'love',
        20 => 'special',
        21 => 'wheeee',
        22 => 'squee',
        23 => 'poison',
        24 => 'treeee',
        25 => 'electric'
    ];

    /**
     * @var array<int, string>
     */
    protected const uniqueRatings = [
        'normal',
        'exotic',
        'legendary'
    ];

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
        } else {
            // check index in dictionary exists
            /*      if (!isset(static::$$dictionary[$index]))
                throw new Exception("$index not found in $dictionary"); */

            return $dictionary[$index];
        }
    }

    /**
     * Returns a list of possible creature stats used in the application.
     * @return \Illuminate\Support\Collection<int, string>
     */
    public static function getPossibleStats()
    {
        return static::getMapping(static::stats);
    }

    /**
     * Translates rarity rating from number to string.
     * @param int $value The rarity rating as a number.
     * @return string
     */
    public static function rarity(int $value): string
    {
        return static::getMapping(static::rarities, $value)[0];
    }

    /**
     * Translates an integer gender and returns the friendly name.
     * @param int $val
     * The gender as a number.
     * Special case: If 3 (both) is passed, "both" will be returned.
     * @return string
     */
    public static function gender(int $val): string
    {
        // 3 (Both is a special case)
        return strtolower(
            $val === CreatureGender::both ? "both" : CreatureGender::get($val)->friendlyName()
        );
    }

    /**
     * Translates a specialty rating from number to string.
     * @param int $val The specialty rating as a number.
     * @return string
     */
    public static function specialty(int $val): string
    {
        return static::getMapping(static::specialties, $val);
    }

    /**
     * Translates an element number to string.
     * @return string
     */
    public static function element(int $val): string
    {
        return static::getMapping(static::elements, $val);
    }

    /**
     * Returns yes or no as to if the creature has basket availability.
     * @return string
     */
    public static function basket(int|bool $val): string
    {
        return $val ? 'Yes' : 'No';
    }

    /**
     * Returns yes or no as to if the creature can be exalted or nobled.
     * @return string
     */
    public static function canExaltNoble(int|bool $val): string
    {
        return !$val ? 'Yes' : 'No';
    }

    /**
     * Translates a numeric unique rating to a string.
     * @return string
     */
    public static function unique(int $val): string
    {
        return static::getMapping(static::uniqueRatings, $val);
    }

    /**
     * Constructs an image url for a given pet.
     * @param UserPet $pet The pet to make an image url from.
     * @return string
     */
    public static function imageLink(UserPet $pet): string
    {
        $creature = &$pet->creature;
        $parts = collect([]);

        if ($pet->specialty > 0 && $pet->specialty <= 2)
            $parts->push(static::specialty($pet->specialty));

        if ($pet->variety)
            $parts->push($pet->variety);

        // creatures with their family name don't follow the same url format...
        $parts->push($creature->family->name);

        if ($creature->family->name !== $creature->name)
            $parts->push($creature->name);

        $path = strtolower("/images/creatures/{$creature->family->name}/{$parts->join('_')}.png");

        return asset($path);
    }
}
