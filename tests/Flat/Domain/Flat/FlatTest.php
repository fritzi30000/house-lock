<?php

namespace HouseLock\Tests\Flat\Domain\Flat;

use HouseLock\Flat\Domain\Exception\CannotRemoveFlatIfThereAreTenants;
use HouseLock\Flat\Domain\Exception\MaxFlatCapacityCannotBeLessThanCurrentTenantNumber;
use HouseLock\Flat\Domain\Flat\Flat;
use HouseLock\Tests\Flat\Application\Command\CreateFlatObjectMother;
use HouseLock\Tests\Shared\AddressObjectMother;
use PHPUnit\Framework\TestCase;

/**
 * @covers \HouseLock\Flat\Domain\Flat\Flat
 */
class FlatTest extends TestCase
{
    public function testShouldCreateFlat(): void
    {
        // Given
        $userId = 1;
        $createFlatCommand = CreateFlatObjectMother::aDefaultFlat();

        // When
        $flat = Flat::create($userId, $createFlatCommand);

        //Then
        self::assertTrue($flat->isUnderAddress($createFlatCommand->address));
        self::assertSame($createFlatCommand->description, $flat->getDescription());
        self::assertSame($createFlatCommand->maximumCapacity, $flat->getMaximumCapacity());
    }

    public function testShouldCreateFlatOfPayload(): void
    {
        // When
        $flat = Flat::ofPayload(FlatPayloadObjectMother::aFlatInKrakowPayload());

        //Then
        self::assertSame('description', $flat->getDescription());
        self::assertSame(3, $flat->getMaximumCapacity());
    }

    public function testShouldUpdateFlatsDescription(): void
    {
        // Given
        $flat = Flat::ofPayload(FlatPayloadObjectMother::aFlatInKrakowPayload());

        // When
        $result = $flat->update('new description');

        //Then
        self::assertTrue($result);
    }

    public function testShouldNotUpdateFlatsDescriptionBecauseItIsTheSame(): void
    {
        // Given
        $flat = Flat::ofPayload(FlatPayloadObjectMother::aFlatInKrakowPayload());

        // When
        $result = $flat->update('description');

        //Then
        self::assertFalse($result);
    }

    public function testShouldUpdateFlatAddress(): void
    {
        // Given
        $flat = Flat::ofPayload(FlatPayloadObjectMother::aFlatInKrakowPayload());

        // When
        $result = $flat->updateAddress(AddressObjectMother::anAddressInWarsaw());

        //Then
        self::assertTrue($result);
    }

    public function testShouldNotUpdateAddressBecauseItIsTheSame(): void
    {
        // Given
        $flat = Flat::ofPayload(FlatPayloadObjectMother::aFlatInKrakowPayload());

        // When
        $result = $flat->updateAddress(AddressObjectMother::anAddressInKrakow());

        //Then
        self::assertFalse($result);
    }

    public function testShouldUpdateMaximumCapacity(): void
    {
        // Given
        $flat = Flat::ofPayload(FlatPayloadObjectMother::aFlatInKrakowPayload());

        // When
        $result = $flat->updateMaximumCapacity(0, 4);

        //Then
        self::assertTrue($result);
    }

    public function testShouldNotUpdateMaximumCapacityBecauseItIsTheSame(): void
    {
        // Given
        $flat = Flat::ofPayload(FlatPayloadObjectMother::aFlatInKrakowPayload());

        // When
        $result = $flat->updateMaximumCapacity(0, 3);

        //Then
        self::assertFalse($result);
    }

    public function testShouldNotUpdateMaximumCapacityBecauseItIsLessThanCurrentTenantNumber(): void
    {
        // Given
        $flat = Flat::ofPayload(FlatPayloadObjectMother::aFlatInKrakowPayload());

        // Expects
        $this->expectException(MaxFlatCapacityCannotBeLessThanCurrentTenantNumber::class);
        $this->expectExceptionMessage('Maximum capacity (2) of flat cannot be less than current number of tenants (3)');

        // When
        $flat->updateMaximumCapacity(3, 2);
    }

    public function testShouldDeleteFlat(): void
    {
        // Given
        $flat = Flat::ofPayload(FlatPayloadObjectMother::aFlatInKrakowPayload());

        // When
        $result = $flat->delete(0);

        //Then
        self::assertTrue($result);
    }

    public function testShouldNotDeleteFlatBecauseThereAreTenants(): void
    {
        // Given
        $flat = Flat::ofPayload(FlatPayloadObjectMother::aFlatInKrakowPayload());

        // Expects
        $this->expectException(CannotRemoveFlatIfThereAreTenants::class);
        $this->expectExceptionMessage('Cannot remove flat if there are tenants (tenants number: 2)');

        // When
        $flat->delete(2);
    }
}
