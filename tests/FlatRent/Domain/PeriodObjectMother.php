<?php

declare(strict_types=1);

namespace HouseLock\Tests\FlatRent\Domain;

use Carbon\Carbon;
use HouseLock\FlatRent\Domain\Period;
use HouseLock\Shared\SystemConstants;

final class PeriodObjectMother
{
    public static function year2020(): Period
    {
        return new Period(
            Carbon::createFromFormat(SystemConstants::DEFAULT_DATE_FORMAT, '2020-01-01'),
            Carbon::createFromFormat(SystemConstants::DEFAULT_DATE_FORMAT, '2020-12-31')
        );
    }

    public static function year2021(): Period
    {
        return new Period(
            Carbon::createFromFormat(SystemConstants::DEFAULT_DATE_FORMAT, '2021-01-01'),
            Carbon::createFromFormat(SystemConstants::DEFAULT_DATE_FORMAT, '2021-12-31')
        );
    }

    public static function yearHalf20202021(): Period
    {
        return new Period(
            Carbon::createFromFormat(SystemConstants::DEFAULT_DATE_FORMAT, '2020-06-01'),
            Carbon::createFromFormat(SystemConstants::DEFAULT_DATE_FORMAT, '2021-05-31')
        );
    }
}