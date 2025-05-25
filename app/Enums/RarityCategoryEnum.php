<?php

namespace App\Enums;

enum RarityCategoryEnum: int
{
    case WTFBBQ = 13;
    case WTF = 12;
    case Seriously = 11;
    case Exotic = 10;
    case EpicRace = 9;
    case Exclusive = 8;
    case Rare = 7;
    case Limited = 6;
    case Scarce = 5;
    case Uncommon = 4;
    case Common = 3;
    case Plentiful = 2;
    case Abundant = 1;
    case Unknown = 0;

    public function chance(): int
    {
        return match ($this) {
            self::WTFBBQ => 0,
            self::WTF => 0,
            self::Seriously => 0,
            self::Exotic => 1,
            self::EpicRace => 0,
            self::Exclusive => 5,
            self::Rare => 2,
            self::Limited => 4,
            self::Scarce => 6,
            self::Uncommon => 10,
            self::Common => 20,
            self::Plentiful => 26,
            self::Abundant => 32,
            self::Unknown => 0,
        };
    }

    public function friendlyName(): string
    {
        return match ($this) {
            self::WTFBBQ => 'WTFBBQ!?',
            self::WTF => 'WTF?',
            self::Seriously => 'Seriously?',
            self::Exotic => 'Exotic',
            self::EpicRace => 'Epic Race',
            self::Exclusive => 'Exclusive',
            self::Rare => 'Rare',
            self::Limited => 'Limited',
            self::Scarce => 'Scarce',
            self::Uncommon => 'Uncommon',
            self::Common => 'Common',
            self::Plentiful => 'Plentiful',
            self::Abundant => 'Abundant',
            self::Unknown => 'Unknown',
        };
    }
}
