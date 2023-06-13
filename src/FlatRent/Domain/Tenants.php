<?php

declare(strict_types=1);

namespace HouseLock\FlatRent\Domain;

use HouseLock\FlatRent\Domain\Exception\FlatRentException;

final class Tenants
{
    /** @var Tenant[] */
    private array $tenants;

    public function __construct(Tenant ...$tenants)
    {
        $this->tenants = $tenants;
    }

    public function getQuantity(): int
    {
        $quantity = 0;
        foreach ($this->tenants as $tenant) {
            $quantity += $tenant->getQuantity();
        }

        return $quantity;
    }

    public function add(Tenant $tenant): bool
    {
        foreach ($tenant->people as $person) {
            if ($this->exists($person)) {
                throw FlatRentException::cannotRentFlatToTheSamePersonAgain($person);
            }
        }
        $this->tenants[] = $tenant;

        return true;
    }

    public function periodOverlapsQuantity(Tenant $tenant): int
    {
        $quantity = 0;
        foreach ($this->tenants as $currentlyRentingTenant) {
            if ($currentlyRentingTenant->period->overlaps($tenant->period)) {
                $quantity += $currentlyRentingTenant->getQuantity();
            }
        }

        return $quantity + $tenant->getQuantity();
    }

    public function updatePeriod(int $tenantId, Period $period)
    {
        $this->find($tenantId)->updatePeriod($period);
    }

    private function exists(Person $person): bool
    {
        foreach ($this->tenants as $currentlyRentingTenant) {
            if ($currentlyRentingTenant->exists($person)) {
                return true;
            }
        }

        return false;
    }

    private function find(int $tenantId): Tenant
    {
        foreach ($this->tenants as $tenant) {
            if ($tenant->getId() === $tenantId) {
                return $tenant;
            }
        }
        throw FlatRentException::cannotFindTenant($tenantId);
    }
}
