<?php

declare(strict_types=1);

namespace HouseLock\Flat\Domain\Flat;

use Carbon\Carbon;
use HouseLock\Flat\Application\Command\CreateFlat;
use HouseLock\Flat\Domain\Exception\CannotRemoveFlatIfThereAreTenants;
use HouseLock\Flat\Domain\Exception\MaxFlatCapacityCannotBeLessThanCurrentTenantNumber;
use HouseLock\Shared\Address;
use HouseLock\Tests\Shared\SystemConst;

final class Flat
{
    public const FLAT_ID = 'flatId';
    public const USER_ID = 'userId';
    public const ADDRESS = 'address';
    public const MAXIMUM_CAPACITY = 'maximumCapacity';
    public const DESCRIPTION = 'description';

    private ?Carbon $deletedAt = null;

    private function __construct(
        private readonly ?FlatId $flatId,
        private Address $address,
        private int $maximumCapacity,
        private string $description
    ) {
    }

    public static function ofPayload(array $payload): self
    {
        return new self(
            new FlatId($payload[self::FLAT_ID], $payload[self::USER_ID]),
            Address::ofPayload($payload[self::ADDRESS]),
            $payload[self::MAXIMUM_CAPACITY],
            $payload[self::DESCRIPTION]
        );
    }

    public static function create(int $userId, CreateFlat $payload): self
    {
        return new self(new FlatId(null, $userId), $payload->address, $payload->maximumCapacity, $payload->description);
    }

    public function update(string $description): bool
    {
        if ($this->description === $description) {
            return false;
        }
        $this->description = $description;
        return true;
    }

    public function updateAddress(Address $address): bool
    {
        if ($this->isUnderAddress($address)) {
            return false;
        }
        $this->address = $address;
        return true;
    }

    public function isUnderAddress(Address $address): bool
    {
        return $this->address->getHash() === $address->getHash();
    }

    public function updateMaximumCapacity($currentTenantNumber, int $maximumCapacity): bool
    {
        if ($currentTenantNumber > $maximumCapacity) {
            throw MaxFlatCapacityCannotBeLessThanCurrentTenantNumber::ofCapacities($currentTenantNumber,
                $maximumCapacity);
        }

        if ($this->maximumCapacity === $maximumCapacity) {
            return false;
        }

        $this->maximumCapacity = $maximumCapacity;
        return true;
    }

    public function delete(int $currentTenantNumber): bool
    {
        if ($currentTenantNumber > 0) {
            throw CannotRemoveFlatIfThereAreTenants::ofNumberOfTenants($currentTenantNumber);
        }
        $this->deletedAt = Carbon::now(SystemConst::DEFAULT_TIMEZONE);
        return true;
    }

    public function getMaximumCapacity(): int
    {
        return $this->maximumCapacity;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getLandlordId(): int
    {
        return $this->flatId->landlordId;
    }
}