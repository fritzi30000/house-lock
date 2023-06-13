<?php

declare(strict_types=1);

namespace HouseLock\Shared;

final class PhoneNumber
{
    public function __construct(public readonly string $value)
    {
    }
}
