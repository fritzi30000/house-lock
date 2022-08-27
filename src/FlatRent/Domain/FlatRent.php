<?php

declare(strict_types=1);

namespace HouseLock\FlatRent\Domain;

use HouseLock\FlatRent\Domain\Exception\FlatRentException;

final class FlatRent
{
    public function __construct(private Tenants $tenants)
    {
    }

    public function rent(Tenant $tenant, int $flatMaxCapacity): bool
    {
        if (!$this->haveEnoughFreeSlots($tenant, $flatMaxCapacity)) {
            throw FlatRentException::cannotRentFlatOverMaximumCapacity(
                $flatMaxCapacity,
                $this->tenants->getQuantity(),
                $tenant->getQuantity()
            );
        }

        if ($tenant->getQuantity() === 0) {
            return false;
        }

        $this->tenants->add($tenant);

        return true;
    }

    public function updatePeriod(int $tenantId, Period $period): bool
    {
        $this->tenants->updatePeriod($tenantId, $period);
        return true;
    }

    private function haveEnoughFreeSlots(Tenant $tenant, int $flatMaxCapacity): bool
    {
        return $this->tenants->periodOverlapsQuantity($tenant) <= $flatMaxCapacity;
    }

    public function payDeposit(int $tenantId): bool
    {
    }
}