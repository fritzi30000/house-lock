<?php

declare(strict_types=1);

namespace HouseLock\Flat\Domain\Flat;

final class FlatId
{
    public function __construct(public readonly ?int $id, public readonly int $landlordId)
    {
    }
}