<?php

declare(strict_types=1);

namespace HouseLock\Flat\Application;

interface TenantishService
{
    public function getCurrentOccupiedSlotsNumber(): int;
}
