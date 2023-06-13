<?php

declare(strict_types=1);

namespace HouseLock\Flat\Domain\Exception;

use HouseLock\Shared\Exception\HouseLockException;
use Symfony\Component\HttpFoundation\Response;

final class CannotRemoveFlatIfThereAreTenants extends HouseLockException
{
    public static function ofNumberOfTenants(int $currentTenantNumber): self
    {
        return new self(
            "Cannot remove flat if there are tenants (tenants number: $currentTenantNumber)",
            Response::HTTP_CONFLICT
        );
    }
}
