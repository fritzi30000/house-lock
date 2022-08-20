<?php

namespace HouseLock\Tests;

use HouseLock\TestService;
use PHPUnit\Framework\TestCase;

class TestServiceTest extends TestCase
{
    public function testShouldTestServiceIndex(): void
    {
        // Given
        $service = new TestService();

        // When
        $result = $service->index();

        //Then
        self::assertTrue($result);
    }
}
