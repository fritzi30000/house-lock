<?php

declare(strict_types=1);

namespace HouseLock\Tests\Flat\Domain\Flat\UtilityBillingConfig;

use HouseLock\Flat\Domain\Flat\UtilityBillingConfig\BillingPeriod;
use HouseLock\Tests\Shared\TimeIntervalMotherObject;

final class BillingPeriodPayloadMotherObject
{
    public static function aTenthOfEveryMonth(): array
    {
        return [
            BillingPeriod::START_AT_DAY => 10,
            BillingPeriod::TIME_INTERVAL => TimeIntervalMotherObject::everyMonth()
        ];
    }

    public static function aFiveteenthOfEveryThreeMonths(): array
    {
        return [
            BillingPeriod::START_AT_DAY => 15,
            BillingPeriod::TIME_INTERVAL => TimeIntervalMotherObject::everyThreeMonths()
        ];
    }

    public static function aFirstOfEveryTwoMonths(): array
    {
        return [
            BillingPeriod::START_AT_DAY => 1,
            BillingPeriod::TIME_INTERVAL => TimeIntervalMotherObject::everyTwoMonths()
        ];
    }
}