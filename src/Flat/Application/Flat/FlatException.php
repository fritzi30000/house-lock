<?php

declare(strict_types=1);

namespace HouseLock\Flat\Application\Flat;

use HouseLock\Shared\Address;
use HouseLock\Shared\Exception\HouseLockException;
use Symfony\Component\HttpFoundation\Response;

final class FlatException extends HouseLockException
{

    public static function alreadyExistsUnderAddress(Address $address): self
    {
        return new self("You have already added flat under such address: {$address->toString()}",
            Response::HTTP_CONFLICT);
    }
}