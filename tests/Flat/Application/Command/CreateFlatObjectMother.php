<?php

namespace HouseLock\Tests\Flat\Application\Command;

use HouseLock\Flat\Application\Command\CreateFlat;
use HouseLock\Tests\Shared\AddressObjectMother;

final class CreateFlatObjectMother
{
    public static function aDefaultFlat(): CreateFlat
    {
        return new CreateFlat(AddressObjectMother::anAddressInKrakow(), 3, 'Some additional description of flat');
    }
}
