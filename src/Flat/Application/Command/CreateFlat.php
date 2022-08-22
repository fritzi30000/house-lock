<?php

declare(strict_types=1);

namespace HouseLock\Flat\Application\Command;

use HouseLock\Shared\Address;
use Money\Money;

final class CreateFlat
{
    public function __construct(
        public readonly Address $address,
        public readonly int $maximumCapacity,
        public readonly string $description,
        public readonly Money $deposit,
        public readonly Money $rentalPrice,
        public readonly array $utilities
    ) {
    }
}