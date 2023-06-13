<?php

declare(strict_types=1);

namespace HouseLock\Flat\Infrastructure\Exception;

use HouseLock\Flat\Domain\Flat\FlatId;
use HouseLock\Shared\Exception\HouseLockException;
use Symfony\Component\HttpFoundation\Response;

final class FlatDoesNotExist extends HouseLockException
{
    public static function ofId(FlatId $flatId): self
    {
        return new self(
            "Flat of id {$flatId->id} of landlord $flatId->landlordId does not exist",
            Response::HTTP_NOT_FOUND
        );
    }
}
