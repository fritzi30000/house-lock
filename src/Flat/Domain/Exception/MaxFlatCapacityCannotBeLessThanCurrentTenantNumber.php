<?php

declare(strict_types=1);

namespace HouseLock\Flat\Domain\Exception;

use HouseLock\Shared\Exception\HouseLockException;
use Symfony\Component\HttpFoundation\Response;

final class MaxFlatCapacityCannotBeLessThanCurrentTenantNumber extends HouseLockException
{
    public static function ofCapacities(int $currentTenantNumber, int $maximumCapacity): self
    {
        return new self("Maximum capacity ($maximumCapacity) of flat cannot be less than current number of tenants ($currentTenantNumber)",
            Response::HTTP_CONFLICT);
    }
}