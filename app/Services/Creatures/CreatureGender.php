<?php

namespace App\Services\Creatures;

use Exception;

class CreatureGender
{
    /**
     * @var both
     * Doesn't indicate a specific gender, but rather that this is available
     * in both genders.
     */
    public final const both = 3;

    /** @var array<int, BaseGender> */
    protected static array $mappings = [
        0 => Male::class,
        1 => Female::class,
        //3 => "Both"
    ];

    /**
     * Returns a gender inheriting from BaseGender throws an exception if not found.
     * @param int $gender
     * An integer to use that should reference a gender in the mappings.
     * If 3 (both) is passed, a random gender will be returned.
     * @return BaseGender
     */
    public static function get(int $gender = 0): BaseGender
    {
        if ($gender === self::both) {
            return self::random();
        }

        if (!isset(self::$mappings[$gender]))
            throw new Exception("BAD GENDER: $gender");

        return new self::$mappings[$gender];
    }

    /**
     * Returns an instance of a random gender from the mappings.
     * @return BaseGender
     */
    public static function random(): BaseGender
    {
        $i = new self::$mappings[rand(0, 1)];
        return $i;
    }

    /**
     * Returns an array of possible pronouns.
     * @return string[]
     */
    public static function pronouns(): array
    {
        return array_keys(Male::pronounConversions());
    }
}

abstract class BaseGender
{
    final const defaultPronouns = [
        'he' => 'he',
        'his' => 'his',
        'him' => 'him',
        'himself' => 'himself',
        'hisself' => 'hisself'
    ];

    /**
     * @var Friendly name for the gender.
     */
    private string $friendlyName;

    /**
     * Returns an array of pronouns and their replacements.
     * @return array<string, string>
     */
    protected abstract static function pronounReplacements(): array;

    /**
     * Returns a human-readable translation of the gender.
     * If friendlyName is specified as a property on the class
     * it will return that, otherwise the name will try to be
     * inferred from the class name.
     * @return string
     */
    public static final function friendlyName(): string
    {
        return strtolower(
            property_exists(static::class, 'friendlyName')
                ? self::$friendlyName
                : (new \ReflectionClass(static::class))->getShortName()
        );
    }

    /**
     * Returns pronouns and their replacements.
     * @return array<string, string>
     */
    public static final function pronounConversions(): array
    {
        // make them lowercase just for good measure
        return array_map('strtolower', static::pronounReplacements());
    }
}

final class Female extends BaseGender
{
    protected static function pronounReplacements(): array
    {
        return [
            'he' => 'she',
            'his' => 'her',
            'him' => 'her',
            'himself' => 'herself',
            'hisself' => 'herself'
        ];
    }
}

final class Male extends BaseGender
{
    protected static function pronounReplacements(): array
    {
        return [
            'he' => 'he',
            'his' => 'his',
            'him' => 'him',
            'himself' => 'himself',
            'hisself' => 'hisself'
        ];
    }
}
