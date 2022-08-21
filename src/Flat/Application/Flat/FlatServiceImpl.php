<?php

declare(strict_types=1);

namespace HouseLock\Flat\Application\Flat;

use HouseLock\Flat\Application\Command\CreateFlat;
use HouseLock\Flat\Application\Command\UpdateFlat;
use HouseLock\Flat\Application\Command\UpdateFlatAddress;
use HouseLock\Flat\Application\Command\UpdateFlatCapacity;
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
        return $this->repository->get($flatId)->update($command->description);
    }

    public function updateFlatAddress(FlatId $flatId, UpdateFlatAddress $command): bool
    {
        if ($this->repository->existsUnderAddress($flatId->landlordId, $command->address)) {
            throw FlatException::alreadyExistsUnderAddress($command->address);
        }
        return $this->repository->get($flatId)->updateAddress($command->address);
    }

    public function updateFlatCapacity(FlatId $flatId, UpdateFlatCapacity $command): bool
    {
        $flat = $this->repository->get($flatId);
        $currentTenantNumber = $this->tenantishService->getCurrentOccupiedSlotsNumber();
        return $flat->updateMaximumCapacity($currentTenantNumber, $command->maximumCapacity);
    }

    public function delete(FlatId $flatId): bool
    {
        $flat = $this->repository->get($flatId);
        $currentTenantNumber = $this->tenantishService->getCurrentOccupiedSlotsNumber();
        return $flat->delete($currentTenantNumber);
    }

}