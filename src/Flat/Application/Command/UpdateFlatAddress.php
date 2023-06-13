<?php

declare(strict_types=1);

namespace HouseLock\Flat\Application\Command;

use HouseLock\Shared\Address;

final class UpdateFlatAddress
{
    public function __construct(public readonly Address $address)
    {
    }
}
