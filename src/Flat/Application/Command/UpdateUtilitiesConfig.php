<?php

declare(strict_types=1);

namespace HouseLock\Flat\Application\Command;

final class UpdateUtilitiesConfig
{
    public function __construct(public readonly array $utilitiesPayload)
    {
    }
}