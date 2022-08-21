<?php

declare(strict_types=1);

namespace HouseLock\Flat\Application;

use HouseLock\Flat\Domain\Flat\Flat;
use HouseLock\Flat\Domain\Flat\FlatId;
use HouseLock\Shared\Address;

interface FlatRepository
{
    public function get(FlatId $flatId): Flat;

    public function existsUnderAddress(int $userId, Address $address): bool;

    public function save(Flat $flat): FlatId;
}