<?php

declare(strict_types=1);

namespace HouseLock\Tests\Flat\Domain\Flat;

use HouseLock\Flat\Domain\Flat\UtilityBillingConfig;
use HouseLock\Flat\Domain\Flat\UtilityType;
use HouseLock\Tests\Flat\Domain\Flat\UtilityBillingConfig\BillingPeriodPayloadMotherObject;
use HouseLock\Tests\Flat\Domain\Flat\UtilityBillingConfig\SettlementStrategy\SettlementStrategyMotherObject;

final class UtilityPayloadMotherObject
{
    public static function aPrepaidGasBilledMonthly(): array
    {
        return [
            UtilityBillingConfig::TYPE => UtilityType::GAS->name,
            UtilityBillingConfig::PERIOD => BillingPeriodPayloadMotherObject::aTenthOfEveryMonth(),
            UtilityBillingConfig::SETTLEMENT_STRATEGY => SettlementStrategyMotherObject::aPrepaidPayload()
        ];
    }

    public static function aBilledWaterOnceInThreeMonths(): array
    {
        return [
            UtilityBillingConfig::TYPE => UtilityType::WATER->name,
            UtilityBillingConfig::PERIOD => BillingPeriodPayloadMotherObject::aFiveteenthOfEveryThreeMonths(),
            UtilityBillingConfig::SETTLEMENT_STRATEGY => SettlementStrategyMotherObject::aBilledPayload()
        ];
    }

    public static function aPowerByMeterBilledMonthly(): array
    {
        return [
            UtilityBillingConfig::TYPE => UtilityType::POWER->name,
            UtilityBillingConfig::PERIOD => BillingPeriodPayloadMotherObject::aTenthOfEveryMonth(),
            UtilityBillingConfig::SETTLEMENT_STRATEGY => SettlementStrategyMotherObject::aByMeterPayload()
        ];
    }

    public static function aCustomUtilityBilledEveryTwoMonths(): array
    {
        return [
            UtilityBillingConfig::TYPE => UtilityType::CUSTOM->name,
            UtilityBillingConfig::PERIOD => BillingPeriodPayloadMotherObject::aFirstOfEveryTwoMonths(),
            UtilityBillingConfig::SETTLEMENT_STRATEGY => SettlementStrategyMotherObject::aBilledPayload(),
            UtilityBillingConfig::NAME => 'Unique name'
        ];
    }

    public static function aCustomUtilityBilledEveryMonth(): array
    {
        return [
            UtilityBillingConfig::TYPE => UtilityType::CUSTOM->name,
            UtilityBillingConfig::PERIOD => BillingPeriodPayloadMotherObject::aTenthOfEveryMonth(),
            UtilityBillingConfig::SETTLEMENT_STRATEGY => SettlementStrategyMotherObject::aBilledPayload(),
            UtilityBillingConfig::NAME => 'Unique name'
        ];
    }
}