<?php

namespace HouseLock\Flat\Application;

use HouseLock\Flat\Application\Command\CreateFlat;
use HouseLock\Flat\Application\Command\UpdateDepositConfig;
use HouseLock\Flat\Application\Command\UpdateFlat;
use HouseLock\Flat\Application\Command\UpdateFlatAddress;
use HouseLock\Flat\Application\Command\UpdateFlatCapacity;
use HouseLock\Flat\Application\Command\UpdateUtilitiesConfig;
use HouseLock\Flat\Domain\Flat\FlatId;

interface FlatService
{
    public function create(int $userId, CreateFlat $command): FlatId;

    public function update(FlatId $flatId, UpdateFlat $command): bool;

    public function updateFlatAddress(FlatId $flatId, UpdateFlatAddress $command): bool;

    public function updateFlatCapacity(FlatId $flatId, UpdateFlatCapacity $command): bool;

    public function updateDepositConfig(FlatId $flatId, UpdateDepositConfig $command): bool;

    public function updateUtilitiesConfig(FlatId $flatId, UpdateUtilitiesConfig $command): bool;

    public function delete(FlatId $flatId): bool;
}