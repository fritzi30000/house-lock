<?php

namespace HouseLock\Tests\FlatRent\Application\Service;

use HouseLock\FlatRent\Application\Service\FlatRentServiceImpl;
use PHPUnit\Framework\TestCase;

class FlatRentServiceImplTest extends TestCase
{
    public function testShouldRentFlatToTenant(): void
    {
        // Given
        $landlordId = 1;
        $tenantId = 1;
        $flatId = 1;
        $flatRentService = new FlatRentServiceImpl();

        // When
        $result = $flatRentService->rentFlat($landlordId, $flatId, $tenantId);

        //Then
        self::assertTrue($result);
    }

    public function testShouldPayDeposit(): void
    {
        // Given
        $tenantId = 1;
        $flatId = 1;
        $flatRentService = new FlatRentServiceImpl();

        // When
        $result = $flatRentService->payDeposit($tenantId, $flatId);

        //Then
        self::assertTrue($result);
    }
    
    public function testShouldEndFlatRent(): void
    {
        // Given
        $tenantId = 1;
        $flatId = 1;
        $flatRentService = new FlatRentServiceImpl();

        // When
        $result = $flatRentService->endRent($tenantId, $flatId);

        //Then
        self::assertTrue($result);
    }
}
