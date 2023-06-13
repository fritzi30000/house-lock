<?php

declare(strict_types=1);

namespace HouseLock\FlatRent\Application;

interface FlatViewModel
{
    public function getFlatMaxCapacity(int $landlordId, int $flatId): int;
}
