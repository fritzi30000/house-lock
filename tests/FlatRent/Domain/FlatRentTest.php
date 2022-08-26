<?php

namespace HouseLock\Tests\FlatRent\Domain;

use HouseLock\FlatRent\Domain\FlatRent;
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
        $flatRent = new FlatRent();
        $tenants = new Tenants([]);

        // When
        $result = $flatRent->rent($tenants, 3);

        //Then
        self::assertTrue($result);
    }

    public function testShouldNotRentFlatBecauseThereAreNoTenants(): void
    {
        // Expects 

        // Given

        // When

        //Then

    }

    public function testShouldNotRentFlatBecauseThereAreNoSlotsLeftInFlat(): void
    {
        // Expects

        // Given

        // When

        //Then

    }
}
