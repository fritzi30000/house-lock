<?php

declare(strict_types=1);

namespace HouseLock\FlatRent\Application\Service;

use HouseLock\FlatRent\Application\FlatRentService;
use HouseLock\FlatRent\Domain\Tenants;

final class FlatRentServiceImpl implements FlatRentService
{

    public function rentFlat(int $landlordId, int $flatId, Tenants $tenants): bool
    {
        $flatMaxCapacity = $this->flatRepository->getFlatMaxCapacity($landlordId, $flatId);
        $flatRent = $this->repository->getFlatRent($flatId);

        $result = $flatRent->rent($tenants);

        if ($result) {
            $this->repository->save($flatRent);
        }

        return $result;
    }

    public function payDeposit(int $tenantId, int $flatId): bool
    {
        return true;
    }

    public function endRent(int $tenantId, int $flatId): bool
    {
        return true;
    }
}