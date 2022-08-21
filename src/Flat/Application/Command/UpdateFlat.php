<?php

declare(strict_types=1);

namespace HouseLock\Flat\Application\Command;

final class UpdateFlat
{
    public function __construct(public readonly string $description)
    {
    }
}