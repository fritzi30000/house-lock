<?php

declare(strict_types=1);

namespace HouseLock\FlatRent\Application;

use HouseLock\FlatRent\Domain\Period;
use HouseLock\FlatRent\Domain\Tenant;

interface FlatRentService
{
    public function rentFlat(int $landlordId, int $flatId, Tenant $tenant): bool;

    public function changePeriod(int $landlordId, int $flatId, int $tenantId, Period $period): bool;

    public function payDeposit(int $landlordId, int $flatId, int $tenantId): bool;

    public function endRent(int $tenantId, int $flatId): bool;
}
