<?php

declare(strict_types=1);

namespace HouseLock\Flat\Domain\Flat\UtilityBillingConfig;

enum SettlementType: string
{
    case PREPAID = 'PREPAID';
    case BILLED = 'BILLED';
    case BY_METER = 'BY_METER';
}
