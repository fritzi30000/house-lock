<?php

declare(strict_types=1);

namespace HouseLock\Flat\Application\Command;

use HouseLock\Shared\Address;

final class CreateFlat
{
    public function __construct(
        public readonly Address $address,
        public readonly int $maximumCapacity,
        public readonly string $description
    ) {
    }
}