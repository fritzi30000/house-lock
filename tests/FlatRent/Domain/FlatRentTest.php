<?php

namespace HouseLock\Tests\FlatRent\Domain;

use HouseLock\FlatRent\Domain\Exception\FlatRentException;
use HouseLock\FlatRent\Domain\FlatRent;
use HouseLock\FlatRent\Domain\Tenant;
use HouseLock\FlatRent\Domain\Tenants;
use PHPUnit\Framework\TestCase;

/**
 * @covers \HouseLock\FlatRent\Domain\FlatRent
 */
class FlatRentTest extends TestCase
{
    public function testShouldRentFlat(): void
    {
        // Given
        $flatRent = new FlatRent(new Tenants());
        $tenant = new Tenant(PeriodObjectMother::year2020(), PersonObjectMother::aPaulJumper());

        // When
        $result = $flatRent->rent($tenant, 3);

        //Then
        self::assertTrue($result);
    }

    public function testShouldNotRentFlatBecauseThereAreNoTenants(): void
    {
        $flatRent = new FlatRent(new Tenants());
        $tenant = new Tenant(PeriodObjectMother::year2020());

        // When
        $result = $flatRent->rent($tenant, 3);

        //Then
        self::assertFalse($result);
    }

    public function testShouldNotRentFlatBecauseThereAreNoSlotsLeftInFlat(): void
    {
        // Given
        $flatRent = new FlatRent(new Tenants(
            new Tenant(PeriodObjectMother::year2020(), PersonObjectMother::aPaulJumper()),
            new Tenant(PeriodObjectMother::year2020(), PersonObjectMother::aKarenSmith())
        ));
        $tenant = new Tenant(PeriodObjectMother::yearHalf20202021(), PersonObjectMother::aJohnSmith());

        // Expects
        $this->expectException(FlatRentException::class);
        $this->expectExceptionMessage('Cannot rent flat with max capacity 2 and taken 2 spots to 1 or more people');

        // When
        $flatRent->rent($tenant, 2);
    }

    public function testShouldRentFlatBecausePeriodsOfRentsDoNotOverlap(): void
    {
        // Given
        $flatRent = new FlatRent(new Tenants(
            new Tenant(PeriodObjectMother::year2020(), PersonObjectMother::aPaulJumper()),
            new Tenant(PeriodObjectMother::year2020(), PersonObjectMother::aKarenSmith())
        ));
        $tenant = new Tenant(PeriodObjectMother::year2021(), PersonObjectMother::aJohnSmith());

        // When
        $result = $flatRent->rent($tenant, 2);

        // Then
        self::assertTrue($result);
    }
}
