<?php

declare(strict_types=1);

namespace HouseLock\Tests\Shared;

use HouseLock\Shared\Address;

final class AddressObjectMother
{
    public static function anAddressInKrakow(): Address
    {
        return Address::ofPayload(self::anAddressInKrakowPayload());
    }

    public static function anAddressInKrakowPayload(): array
    {
        return [
            Address::STREET => 'Street',
            Address::BUILDING_NUMBER => '43a',
            Address::FLAT_NUMBER => '2',
            Address::POSTAL_CODE => '23-234',
            Address::CITY => 'Kraków',
            Address::COUNTRY_CODE => 'PL'
        ];
    }

    public static function anAddressInWarsaw(): Address
    {
        return Address::ofPayload(self::anAddressInWarsawPayload());
    }

    private static function anAddressInWarsawPayload(): array
    {
        return [
            Address::STREET => 'Street',
            Address::BUILDING_NUMBER => '43a',
            Address::FLAT_NUMBER => '2',
            Address::POSTAL_CODE => '23-234',
            Address::CITY => 'Warsaw',
            Address::COUNTRY_CODE => 'PL'
        ];
    }
}