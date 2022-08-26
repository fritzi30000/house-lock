<?php

declare(strict_types=1);

namespace HouseLock\FlatRent\Domain;

final class Tenants
{

    /**
     * @param Person[] $people
     */
    public function __construct(public readonly array $people)
    {
    }

    public function getQuantity(): int
    {
        return count($this->people);
    }

    public function exists(Person $person): bool
    {
        foreach ($this->people as $currentlyRentingPerson) {
            if ($currentlyRentingPerson->equals($person)) {
                return true;
            }
        }
        return false;
    }
}