<?php

declare(strict_types=1);

namespace HouseLock\FlatRent\Domain;

use function count;

final class Tenant
{
    /** @var Person[] */
    public readonly array $people;

    public function __construct(private Period $period, Person ...$people)
    {
        $this->people = $people;
    }

    public function getId(): int
    {
        // todo
    }

    public function getQuantity(): int
    {
        return count($this->people);
    }

    public function updatePeriod(Period $period): bool
    {
        $this->period = $period;

        return true;
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

    public function getPeriod(): Period
    {
        return $this->period;
    }
}
