<?php

namespace HouseLock\Tests\FlatRent\Domain;

use HouseLock\FlatRent\Domain\Tenant;
use PHPUnit\Framework\TestCase;

/**
 * @covers \HouseLock\FlatRent\Domain\Tenant
 */
class TenantTest extends TestCase
{
    public function testShouldCreateTenant(): void
    {
        // Given
        $people = [
            PersonObjectMother::aJohnSmith(),
            PersonObjectMother::aKarenSmith(),
        ];

        // When
        $tenant = new Tenant(PeriodObjectMother::year2021(), ...$people);

        //Then
        self::assertSame(2, $tenant->getQuantity());
        self::assertTrue($tenant->exists(PersonObjectMother::aJohnSmith()));
        self::assertFalse($tenant->exists(PersonObjectMother::aPaulJumper()));
    }
}
