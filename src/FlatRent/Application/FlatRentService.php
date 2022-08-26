<?php

declare(strict_types=1);

namespace HouseLock\FlatRent\Application;

use HouseLock\FlatRent\Domain\Tenants;

interface FlatRentService
{
    public function rentFlat(int $landlordId, int $flatId, Tenants $tenants): bool;

    public function payDeposit(int $tenantId, int $flatId): bool;

    public function endRent(int $tenantId, int $flatId): bool;
}