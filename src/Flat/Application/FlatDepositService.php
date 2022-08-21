<?php

declare(strict_types=1);

namespace HouseLock\Flat\Application;

interface FlatDepositService
{
    public function update(): bool;
}