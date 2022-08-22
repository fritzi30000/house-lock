<?php

declare(strict_types=1);

namespace HouseLock\Tests\Flat\Domain\Flat\UtilityBillingConfig\SettlementStrategy;

use HouseLock\Flat\Domain\Flat\UtilityBillingConfig\BillingPeriodSettlementStrategy;
use HouseLock\Flat\Domain\Flat\UtilityBillingConfig\SettlementStrategy\Billed;
use HouseLock\Flat\Domain\Flat\UtilityBillingConfig\SettlementStrategy\ByMeter;
use HouseLock\Flat\Domain\Flat\UtilityBillingConfig\SettlementStrategy\Prepaid;
use HouseLock\Flat\Domain\Flat\UtilityBillingConfig\SettlementType;

final class SettlementStrategyMotherObject
{
    public static function aPrepaid(): BillingPeriodSettlementStrategy
    {
        return Prepaid::ofPayload(self::aPrepaidPayload());
    }

    public static function aPrepaidPayload(): array
    {
        return [
            BillingPeriodSettlementStrategy::TYPE => SettlementType::PREPAID->value,
            Prepaid::PRICE => 2000,
            Prepaid::CURRENCY => 'EUR'
        ];
    }

    public static function aBilled(): BillingPeriodSettlementStrategy
    {
        return Billed::ofPayload(self::aBilledPayload());
    }

    public static function aBilledPayload(): array
    {
        return [
            BillingPeriodSettlementStrategy::TYPE => SettlementType::BILLED->value,
        ];
    }

    public static function aByMeter(): BillingPeriodSettlementStrategy
    {
        return ByMeter::ofPayload(self::aByMeterPayload());
    }

    public static function aByMeterPayload(): array
    {
        return [
            BillingPeriodSettlementStrategy::TYPE => SettlementType::BY_METER->value,
        ];
    }
}