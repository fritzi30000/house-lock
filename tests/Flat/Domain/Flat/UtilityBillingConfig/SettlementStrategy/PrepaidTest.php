<?php

namespace HouseLock\Tests\Flat\Domain\Flat\UtilityBillingConfig\SettlementStrategy;

use HouseLock\Flat\Domain\Flat\UtilityBillingConfig\BillingPeriodSettlementStrategy;
use HouseLock\Flat\Domain\Flat\UtilityBillingConfig\SettlementStrategy\Prepaid;
use HouseLock\Flat\Domain\Flat\UtilityBillingConfig\SettlementType;
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
        self::assertSame([
            BillingPeriodSettlementStrategy::TYPE => SettlementType::PREPAID->value,
            Prepaid::PRICE => '2000',
            Prepaid::CURRENCY => 'EUR'
        ], $result->serialize());
    }
}
