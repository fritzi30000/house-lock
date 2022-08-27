<?php

namespace HouseLock\Tests\FlatRent\Domain;

use HouseLock\FlatRent\Domain\Exception\FlatRentException;
use HouseLock\FlatRent\Domain\Tenant;
use HouseLock\FlatRent\Domain\Tenants;
use PHPUnit\Framework\TestCase;

/**
 * @covers \HouseLock\FlatRent\Domain\Tenants
 */
class TenantsTest extends TestCase
{
    public function testShouldCreateTenants(): void
    {
        // When
        $tenants = new Tenants(
            new Tenant(PeriodObjectMother::year2021(), PersonObjectMother::aJohnSmith(),
                PersonObjectMother::aKarenSmith()),
            new Tenant(PeriodObjectMother::year2021(), PersonObjectMother::aPaulJumper())
        );

        //Then
        self::assertSame(3, $tenants->getQuantity());
    }

    public function testShouldAddTenant(): void
    {
        // Given
        $tenants = new Tenants(
            new Tenant(PeriodObjectMother::year2021(), PersonObjectMother::aJohnSmith()),
            new Tenant(PeriodObjectMother::year2021(), PersonObjectMother::aKarenSmith())
        );

        // When
        $tenants->add(new Tenant(PeriodObjectMother::year2021(), PersonObjectMother::aPaulJumper()));

        //Then
        self::assertSame(3, $tenants->getQuantity());
    }

    public function testShouldNotAddTenantThatAlreadyRentsFlat(): void
    {
        // Given
        $tenants = new Tenants(
            new Tenant(PeriodObjectMother::year2021(), PersonObjectMother::aJohnSmith(),
                PersonObjectMother::aKarenSmith()),
            new Tenant(PeriodObjectMother::year2021(), PersonObjectMother::aPaulJumper())
        );

        // Expects
        $this->expectException(FlatRentException::class);
        $this->expectExceptionMessage('Cannot rent flat to the same person again: PASSPORT YB44356, Paul Jumper, email: paul.jumper@email.com, phone: +44666000666');

        // When
        $tenants->add(new Tenant(PeriodObjectMother::year2021(), PersonObjectMother::aPaulJumper()));
    }
}
