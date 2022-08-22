<?php

namespace HouseLock\Tests\Flat\Domain\Flat\UtilityBillingConfig\SettlementStrategy;

use HouseLock\Flat\Domain\Flat\UtilityBillingConfig\SettlementStrategy\Prepaid;
use PHPUnit\Framework\TestCase;

/**
 * @covers \HouseLock\Flat\Domain\Flat\UtilityBillingConfig\SettlementStrategy\Prepaid
 */
class PrepaidTest extends TestCase
{
    public function testShouldCreateOfPayload(): void
    {
        // When
        $result = Prepaid::ofPayload(SettlementStrategyMotherObject::aPrepaidPayload());

        //Then
        self::assertSame('{"type":"PREPAID","price":"2000","currency":"EUR"}', $result->serialize());
    }
}
