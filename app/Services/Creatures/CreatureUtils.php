<?php

namespace App\Services\Creatures;

use App\Models\UserPet;

class CreatureUtils
{
    /**
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
     * Tramslates rarity rating
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
     * Handles gender-y things.
     */
    public static function gender(int $val = null)
    {
        if ($val === null)
            return CreatureGender::class;

        return CreatureGender::get($val);
    }

    /**
     * Translates specialties
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

    public static function imageLink(UserPet $pet): string
    {
        $creature = &$pet->creature;
        $parts = collect([]);

        if ($pet->specialty > 0 && $pet->specialty <= 1)
            $parts->push(self::specialty($pet->specialty));

        // creatures with their family name don't follow the same url format...
        $parts->push($creature->family->name);

        if ($creature->family->name !== $creature->name)
            $parts->push($creature->name);

        $path = strtolower("/images/creatures/{$creature->family->name}/{$parts->join('_')}.png");

        return asset($path);
    }
}
