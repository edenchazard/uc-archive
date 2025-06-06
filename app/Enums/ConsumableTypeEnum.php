<?php

namespace App\Enums;

enum ConsumableTypeEnum: string
{
    case RareComponent = 'Rare Component';
    case Standard = 'Standard';
    case BuildingMaterial = 'Building Material';
    case Tree = 'Tree';
    case Orb = 'Orb';
    case Shard = 'Shard';
    case Other = 'Other';
}
