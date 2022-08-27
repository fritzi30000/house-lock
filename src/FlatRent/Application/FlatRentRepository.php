<?php

declare(strict_types=1);

namespace HouseLock\FlatRent\Application;

use HouseLock\FlatRent\Domain\FlatRent;

interface FlatRentRepository
{
    public function getFlatRent(int $flatId, int $landlordId): FlatRent;

    public function save(FlatRent $flatRent): bool;
}