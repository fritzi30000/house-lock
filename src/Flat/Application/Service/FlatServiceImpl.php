<?php

declare(strict_types=1);

namespace HouseLock\Flat\Application\Service;

use HouseLock\Flat\Application\Command\CreateFlat;
use HouseLock\Flat\Application\Command\UpdateDepositConfig;
use HouseLock\Flat\Application\Command\UpdateFlat;
use HouseLock\Flat\Application\Command\UpdateFlatAddress;
use HouseLock\Flat\Application\Command\UpdateFlatCapacity;
use HouseLock\Flat\Application\Command\UpdateUtilitiesConfig;
use HouseLock\Flat\Application\FlatException;
use HouseLock\Flat\Application\FlatRepository;
use HouseLock\Flat\Application\FlatService;
use HouseLock\Flat\Domain\Flat\Flat;
use HouseLock\Flat\Domain\Flat\FlatId;

final class FlatServiceImpl implements FlatService
{
    public function __construct(private readonly FlatRepository $repository)
    {
    }

    public function create(int $userId, CreateFlat $command): FlatId
    {
        if ($this->repository->existsUnderAddress($userId, $command->address)) {
            throw FlatException::alreadyExistsUnderAddress($command->address);
        }
        $flat = Flat::create($userId, $command);
        return $this->repository->save($flat);
    }

    public function update(FlatId $flatId, UpdateFlat $command): bool
    {
        $flat = $this->repository->get($flatId);
        $result = $flat->update($command->description);
        return $this->save($result, $flat);
    }

    public function updateFlatAddress(FlatId $flatId, UpdateFlatAddress $command): bool
    {
        if ($this->repository->existsUnderAddress($flatId->landlordId, $command->address)) {
            throw FlatException::alreadyExistsUnderAddress($command->address);
        }
        $flat = $this->repository->get($flatId);
        $result = $flat->updateAddress($command->address);
        return $this->save($result, $flat);
    }

    public function updateFlatCapacity(FlatId $flatId, UpdateFlatCapacity $command): bool
    {
        $flat = $this->repository->get($flatId);
        $currentTenantNumber = $this->tenantishService->getCurrentOccupiedSlotsNumber();
        $result = $flat->updateMaximumCapacity($currentTenantNumber, $command->maximumCapacity);
        return $this->save($result, $flat);
    }

    public function updateDepositConfig(FlatId $flatId, UpdateDepositConfig $command): bool
    {
        $flat = $this->repository->get($flatId);
        $result = $flat->updateDeposit($command->deposit);
        return $this->save($result, $flat);
    }

    public function updateUtilitiesConfig(FlatId $flatId, UpdateUtilitiesConfig $command): bool
    {
        $flat = $this->repository->get($flatId);
        $result = $flat->updateUtilitiesConfig($command->utilitiesPayload);
        return $this->save($result, $flat);
    }

    public function delete(FlatId $flatId): bool
    {
        $flat = $this->repository->get($flatId);
        $currentTenantNumber = $this->tenantishService->getCurrentOccupiedSlotsNumber();
        $result = $flat->delete($currentTenantNumber);
        return $this->save($result, $flat);
    }

    private function save(bool $result, Flat $flat): bool
    {
        if ($result) {
            $this->repository->save($flat);
        }
        return $result;
    }

}