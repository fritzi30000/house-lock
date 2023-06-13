<?php

declare(strict_types=1);

namespace HouseLock\Flat\Application\Command;

final class UpdateFlatCapacity
{
    public function __construct(
        public readonly int $maximumCapacity
    ) {
    }
}
