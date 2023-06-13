<?php

declare(strict_types=1);

namespace HouseLock\Flat\Domain\Flat;

enum UtilityType: string
{
    case RENT = 'RENT';
    case WATER = 'WATER';
    case POWER = 'POWER';
    case GAS = 'GAS';
    case INTERNET = 'INTERNET';
    case CUSTOM = 'CUSTOM';
}
