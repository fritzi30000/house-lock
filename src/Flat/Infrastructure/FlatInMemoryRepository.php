<?php

declare(strict_types=1);

namespace HouseLock\Flat\Infrastructure;

use HouseLock\Flat\Application\FlatRepository;
use HouseLock\Flat\Domain\Flat\Flat;
use HouseLock\Flat\Domain\Flat\FlatId;
use HouseLock\Flat\Infrastructure\Exception\FlatDoesNotExist;
use HouseLock\Shared\Address;

final class FlatInMemoryRepository implements FlatRepository
{
    /**
     * @param Flat[] $flats
     */
    public function __construct(private array $flats = [])
    {
    }

    public function get(FlatId $flatId): Flat
    {
        if (!isset($this->flats[$flatId->id]) || $this->flats[$flatId->id]->getLandlordId() !== $flatId->landlordId) {
            throw FlatDoesNotExist::ofId($flatId);
        }
        return $this->flats[$flatId->id];
    }


    public function existsUnderAddress(int $userId, Address $address): bool
    {
        foreach ($this->flats as $flat) {
            if ($flat->isUnderAddress($address)) {
                return true;
            }
        }
        return false;
    }

    public function save(Flat $flat): FlatId
    {
        $this->flats[] = $flat;
        return new FlatId((int)array_key_last($this->flats), $flat->getLandlordId());
    }

}