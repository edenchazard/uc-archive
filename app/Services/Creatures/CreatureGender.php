<?php
namespace App\Services\Creatures;
use Exception;

class CreatureGender {
    protected static array $mappings = [
        0 => Male::class,
        1 => Female::class,
        3 => Both::class
    ];

    public static function get(int $genderValue = 2): BaseGender {
        if(!array_key_exists($genderValue, self::$mappings))
            throw new Exception("BAD GENDER: $genderValue");

        return new self::$mappings[$genderValue];
    }

    public function random() {
        return self::$mappings[rand(0, 1)];
    }

    public static function pronouns(): array {
        return array_keys(Male::pronounConversions());
    }
}

abstract class BaseGender {
    /**
     * This needs completing in any child classes.
     */
    protected static array $pronouns = [];

    public static function friendlyName(): string{
        return (new \ReflectionClass(static::class))->getShortName();
    }

    public static function pronounConversions(): array {
        // make them lowercase just for good measure
        return array_map('strtolower', static::$pronouns);
    }
}

class Female extends BaseGender {
    protected static array $pronouns = [
        'he' => 'she',
        'his' => 'her',
        'him' => 'her'
    ];
}

class Male extends BaseGender {
    protected static array $pronouns = [
        'he' => 'he',
        'his' => 'his',
        'him' => 'him'
    ];
}

class Both extends BaseGender { }
?>