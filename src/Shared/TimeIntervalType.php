<?php

declare(strict_types=1);

namespace HouseLock\Shared;

enum TimeIntervalType: string
{
    case WEEK = 'WEEK';
    case MONTH = 'MONTH';
}