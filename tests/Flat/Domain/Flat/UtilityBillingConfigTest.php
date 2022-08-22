<?php

namespace HouseLock\Tests\Flat\Domain\Flat;

use HouseLock\Flat\Domain\Flat\UtilityBillingConfig;
use PHPUnit\Framework\TestCase;

/**
 * @covers \HouseLock\Flat\Domain\Flat\UtilityBillingConfig
 */
class UtilityBillingConfigTest extends TestCase
{
    /**
     * @param array $payload
     * @param string $expectedId
     * @return void
     * @dataProvider utilityPayloads
     */
    public function testShouldCreateConfig(array $payload, string $expectedId): void
    {
        // When
        $utilityConfig = UtilityBillingConfig::ofPayload($payload);

        //Then
        self::assertSame($expectedId, $utilityConfig->getId());
    }

    public function utilityPayloads(): array
    {
        return [
            [
                UtilityPayloadMotherObject::aPrepaidGasBilledMonthly(),
                'GAS'
            ],
            [
                UtilityPayloadMotherObject::aBilledWaterOnceInThreeMonths(),
                'WATER'
            ],
            [
                UtilityPayloadMotherObject::aPowerByMeterBilledMonthly(),
                'POWER'
            ],
            [
                UtilityPayloadMotherObject::aCustomUtilityBilledEveryTwoMonths(),
                'CUSTOM_76aeab63a36298ab54940aa1b9114b6a'
            ]
        ];
    }
}
