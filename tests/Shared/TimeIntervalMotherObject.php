<?php

declare(strict_types=1);

namespace HouseLock\Tests\Shared;

use HouseLock\Shared\TimeInterval;
use HouseLock\Shared\TimeIntervalType;

final class TimeIntervalMotherObject
{
    public static function everyMonth(): array
    {
        return [
            TimeInterval::INTERVAL => 1,
            TimeInterval::TYPE => TimeIntervalType::MONTH->name
        ];
    }

    public static function everyTwoMonths(): array
    {
        return [
            TimeInterval::INTERVAL => 2,
            TimeInterval::TYPE => TimeIntervalType::MONTH->name
        ];
    }

    public static function everyThreeMonths(): array
    {
        return [
            TimeInterval::INTERVAL => 3,
            TimeInterval::TYPE => TimeIntervalType::MONTH->name
        ];
    }

    public static function everyThreeWeeks(): array
    {
        return [
            TimeInterval::INTERVAL => 3,
            TimeInterval::TYPE => TimeIntervalType::WEEK->name
        ];
    }
}