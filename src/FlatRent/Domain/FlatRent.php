<?php

declare(strict_types=1);

namespace HouseLock\FlatRent\Domain;

final class FlatRent
{
    public function __construct(private Tenants $tenants)
    {
    }

    public function rent(Tenants $tenants, int $flatMaxCapacity): bool
    {
        if (!$this->haveEnoughFreeSlots($tenants->getQuantity(), $flatMaxCapacity)) {
            throw FlatRentException::cannotRentFlatOverMaximumCapacity(
                $flatMaxCapacity,
                $this->tenants->getQuantity(),
                $tenants->getQuantity()
            );
        }

        if (empty($tenants->people)) {
            return false;
        }

        foreach ($tenants->people as $person) {
            if ($this->tenants->exists($person)) {
                throw FlatRentException::cannotRentFlatToTheSamePersonAgain($person);
            }
            $this->tenants->add($person);
        }

        return true;
    }

    private function haveEnoughFreeSlots(int $newTenantsQuantity, int $flatMaxCapacity): bool
    {
        return $this->tenants->getQuantity() + $newTenantsQuantity <= $flatMaxCapacity;
    }
}