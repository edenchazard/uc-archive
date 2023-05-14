<?php

namespace App\Services\Creatures;

use App\Models\UserPet;

class CreatureUtils
{
    /**
     * Returns a list of possible creature stats used in the application.
     * @return \Illuminate\Support\Collection<int, string>
     */
    public static function getPossibleStats()
    {
        return collect([
            'strength',
            'agility',
            'speed',
            'intelligence',
            'wisdom',
            'charisma',
            'creativity',
            'willpower',
            'focus'
        ]);
    }

    /**
     * Translates rarity rating from number to string.
     * @param int $value The rarity rating as a number.
     * @return string
     */
    public static function rarity(int $value): string
    {
        $mappings = [
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

        return $mappings[$value][0];
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
        $mappings = [
            0 => '', //regular
            1 => 'noble',
            2 => 'exalted',
            3 => 'exotic',
            4 => 'legendary'
        ];

        return $mappings[$val];
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
            $parts->push(self::specialty($pet->specialty));

        // creatures with their family name don't follow the same url format...
        $parts->push($creature->family->name);

        if ($creature->family->name !== $creature->name)
            $parts->push($creature->name);

        $path = strtolower("/images/creatures/{$creature->family->name}/{$parts->join('_')}.png");

        return asset($path);
    }
}
