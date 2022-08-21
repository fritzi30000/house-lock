<?php

declare(strict_types=1);

namespace HouseLock\Tests\Flat\Domain\Flat;

use HouseLock\Flat\Domain\Flat\Flat;
use HouseLock\Tests\Shared\AddressObjectMother;

final class FlatPayloadObjectMother
{
    public static function aFlatInKrakowPayload(): array
    {
        return [
            Flat::FLAT_ID => 1,
            Flat::USER_ID => 1,
            Flat::ADDRESS => AddressObjectMother::anAddressInKrakowPayload(),
            Flat::DESCRIPTION => 'description',
            Flat::MAXIMUM_CAPACITY => 3
        ];
    }
}