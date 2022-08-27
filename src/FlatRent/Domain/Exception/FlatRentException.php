<?php

declare(strict_types=1);

namespace HouseLock\FlatRent\Domain\Exception;

use HouseLock\FlatRent\Domain\Person;
use HouseLock\Shared\Exception\HouseLockException;
use Symfony\Component\HttpFoundation\Response;

final class FlatRentException extends HouseLockException
{
    public static function cannotRentFlatOverMaximumCapacity(
        int $flatMaxCapacity,
        int $occupiedByNumber,
        int $newPeopleNumber
    ): self {
        return new self("Cannot rent flat with max capacity $flatMaxCapacity and taken $occupiedByNumber spots to $newPeopleNumber or more people",
            Response::HTTP_CONFLICT);
    }

    public static function cannotRentFlatToTheSamePersonAgain(Person $person): self
    {
        return new self("Cannot rent flat to the same person again: {$person->serialize()}",
            Response::HTTP_CONFLICT);
    }

    public static function cannotFindTenant(int $tenantId): self
    {
        return new self("Cannot find tenant of ID $tenantId", Response::HTTP_CONFLICT);
    }
}