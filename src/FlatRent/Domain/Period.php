<?php

declare(strict_types=1);

namespace HouseLock\FlatRent\Domain;

use Carbon\Carbon;

final class Period
{
    public function __construct(private readonly Carbon $startAt, private readonly ?Carbon $endAt)
    {
    }

    public function overlaps(Period $period): bool
    {
        return $this->inPeriod($period->startAt) || $this->inPeriod($period->endAt);
    }

    public function inPeriod(Carbon $date): bool
    {
        return $this->startAt <= $date && (!$this->endAt || $date <= $this->endAt);
    }
}