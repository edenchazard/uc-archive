<?php
namespace App\Services\Creatures;

class CreatureUtils {
    /**
     * Tramslates rarity rating
     */
    public static function rarity(int $value): string {
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
    public static function gender(int $val = null){
        if($val === null)
            return CreatureGender::class;

        return CreatureGender::get($val);
    }

    /**
     * Translates specialties
     */
    public static function specialty(int $val){
        $mappings = [
            0 => '', //regular
            1 => 'noble',
            2 => 'exalted',
            3 => 'exotic',
            4 => 'legendary'
        ];

        return $mappings[$val];
    }
}
?>