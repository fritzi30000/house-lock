<?php

declare(strict_types=1);

namespace HouseLock\FlatRent\Application\Service;

use HouseLock\FlatRent\Application\FlatRentRepository;
use HouseLock\FlatRent\Application\FlatRentService;
use HouseLock\FlatRent\Application\FlatViewModel;
use HouseLock\FlatRent\Domain\Period;
use HouseLock\FlatRent\Domain\Tenant;

final class FlatRentServiceImpl implements FlatRentService
{
    public function __construct(
        private readonly FlatRentRepository $repository,
        private readonly FlatViewModel $flatViewModel
    ) {
    }


    public function rentFlat(int $landlordId, int $flatId, Tenant $tenant): bool
    {
        $flatMaxCapacity = $this->flatViewModel->getFlatMaxCapacity($landlordId, $flatId);
        $flatRent = $this->repository->getFlatRent($flatId, $landlordId);

        $result = $flatRent->rent($tenant, $flatMaxCapacity);

        if ($result) {
            $this->repository->save($flatRent);
        }

        return $result;
    }

    public function changePeriod(int $landlordId, int $flatId, int $tenantId, Period $period): bool
    {
        $flatRent = $this->repository->getFlatRent($tenantId, $landlordId);

        $result = $flatRent->updatePeriod($tenantId, $period);

        if ($result) {
            $this->repository->save($flatRent);
        }

        return $result;
        //check if start date changed -> any open billings -> yes -> close billing -> change date
        //if end date changed  -> any open billings past this date -> yes -> close billings -> change date
    }

    public function payDeposit(int $landlordId, int $flatId, int $tenantId): bool
    {
        //pay deposit
        $flatRent = $this->repository->getFlatRent($tenantId, $landlordId);
        $result = $flatRent->payDeposit($tenantId);

        if ($result) {
            $this->repository->save($flatRent);
        }

        return $result;
    }

    public function endRent(int $tenantId, int $flatId): bool
    {
        //mark as inactive and archive somehow
        return true;
    }
}