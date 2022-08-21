<?php

declare(strict_types=1);

namespace HouseLock\Shared;

final class Address
{
    public const STREET = 'street';
    public const BUILDING_NUMBER = 'buildingNumber';
    public const FLAT_NUMBER = 'flatNumber';
    public const POSTAL_CODE = 'postalCode';
    public const CITY = 'city';
    public const COUNTRY_CODE = 'countryCode';
    public const PROVINCE_CODE = 'provinceCode';

    public function __construct(
        public readonly string $street,
        public readonly string $buildingNumber,
        public readonly string $flatNumber,
        public readonly string $postalCode,
        public readonly string $city,
        public readonly string $countryCode, //todo value object / library
        public readonly ?string $province = null
    ) {
    }

    public static function ofPayload(array $payload): self
    {
        return new self(
            $payload[self::STREET],
            $payload[self::BUILDING_NUMBER],
            $payload[self::FLAT_NUMBER],
            $payload[self::POSTAL_CODE],
            $payload[self::CITY],
            $payload[self::COUNTRY_CODE],
            $payload[self::PROVINCE_CODE] ?? null
        );
    }

    public function toString(): string
    {
        return "$this->street $this->buildingNumber/$this->flatNumber, $this->postalCode $this->city, $this->countryCode";
    }

    public function getHash(): string
    {
        return md5("$this->street$this->buildingNumber$this->flatNumber$this->postalCode$this->city$this->countryCode");
    }
}