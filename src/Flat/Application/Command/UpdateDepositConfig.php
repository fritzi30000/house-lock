<?php

declare(strict_types=1);

namespace HouseLock\Flat\Application\Command;

use Money\Money;

final class UpdateDepositConfig
{
    public function __construct(public readonly Money $deposit)
    {
    }
}