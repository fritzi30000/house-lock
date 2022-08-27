<?php

declare(strict_types=1);

namespace HouseLock\FlatRent\Domain\Exception;

use HouseLock\Shared\Exception\HouseLockException;

final class PersonException extends HouseLockException
{
    public static function personIdValueCannotBeEmpty(): self
    {
        return new self('Person ID value cannot be empty');
    }
}