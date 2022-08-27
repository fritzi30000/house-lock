<?php

declare(strict_types=1);

namespace HouseLock\Shared;

final class Email
{
    public function __construct(public readonly string $value)
    {
    }
}