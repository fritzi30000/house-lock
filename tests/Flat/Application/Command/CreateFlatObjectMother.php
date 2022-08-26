<?php

namespace HouseLock\Tests\Flat\Application\Command;

use HouseLock\Flat\Application\Command\CreateFlat;
use HouseLock\Tests\Shared\AddressObjectMother;
use Money\Currency;
use Money\Money;

final class CreateFlatObjectMother
{
    public static function aDefaultFlat(): CreateFlat
    {
        return new CreateFlat(
            AddressObjectMother::anAddressInKrakow(),
            3,
            'Some additional description of flat',
            new Money(250000, new Currency('EUR')),
            []
        );
    }
}
