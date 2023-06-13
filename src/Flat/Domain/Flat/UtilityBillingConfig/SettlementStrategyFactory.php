<?php

declare(strict_types=1);

namespace HouseLock\Flat\Domain\Flat\UtilityBillingConfig;

use Exception;
use HouseLock\Flat\Domain\Flat\UtilityBillingConfig\SettlementStrategy\Billed;
use HouseLock\Flat\Domain\Flat\UtilityBillingConfig\SettlementStrategy\ByMeter;
use HouseLock\Flat\Domain\Flat\UtilityBillingConfig\SettlementStrategy\Prepaid;

final class SettlementStrategyFactory
{
    private const TYPE = 'type';

    public static function ofPayload(array $payload): BillingPeriodSettlementStrategy
    {
        $settlementStrategyType = SettlementType::from($payload[self::TYPE]);
        if ($settlementStrategyType === SettlementType::PREPAID) {
            return Prepaid::ofPayload($payload);
        }

        if ($settlementStrategyType === SettlementType::BILLED) {
            return Billed::ofPayload($payload);
        }

        if ($settlementStrategyType === SettlementType::BY_METER) {
            return ByMeter::ofPayload($payload);
        }
        throw new Exception('unsupported type');
    }
}
