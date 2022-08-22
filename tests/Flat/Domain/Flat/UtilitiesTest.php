<?php

namespace HouseLock\Tests\Flat\Domain\Flat;

use HouseLock\Flat\Domain\Flat\Utilities;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

/**
 * @covers \HouseLock\Flat\Domain\Flat\Utilities
 */
class UtilitiesTest extends TestCase
{
    public function testShouldCheckThatUtilitiesDiffer(): void
    {
        // Given
        $currentUtilities = Utilities::ofPayload([
            UtilityPayloadMotherObject::aBilledWaterOnceInThreeMonths(),
            UtilityPayloadMotherObject::aPowerByMeterBilledMonthly()
        ]);
        $payload = [
            UtilityPayloadMotherObject::aPrepaidGasBilledMonthly(),
            UtilityPayloadMotherObject::aBilledWaterOnceInThreeMonths(),
            UtilityPayloadMotherObject::aPowerByMeterBilledMonthly(),
            UtilityPayloadMotherObject::aCustomUtilityBilledEveryTwoMonths()
        ];

        // When
        $utilities = Utilities::ofPayload($payload);

        //Then
        self::assertFalse($currentUtilities->equals($utilities));
    }

    public function testShouldCheckThatUtilitiesAreTheSame(): void
    {
        // Given
        $currentUtilities = Utilities::ofPayload([
            UtilityPayloadMotherObject::aBilledWaterOnceInThreeMonths(),
            UtilityPayloadMotherObject::aPowerByMeterBilledMonthly()
        ]);
        $payload = [
            UtilityPayloadMotherObject::aBilledWaterOnceInThreeMonths(),
            UtilityPayloadMotherObject::aPowerByMeterBilledMonthly()
        ];

        // When
        $utilities = Utilities::ofPayload($payload);

        //Then
        self::assertTrue($currentUtilities->equals($utilities));
    }

    public function testShouldFlattenUtilitiesOfTheSameIds(): void
    {
        // Given
        $payload = [
            UtilityPayloadMotherObject::aPrepaidGasBilledMonthly(),
            UtilityPayloadMotherObject::aBilledWaterOnceInThreeMonths(),
            UtilityPayloadMotherObject::aPowerByMeterBilledMonthly(),
            UtilityPayloadMotherObject::aCustomUtilityBilledEveryTwoMonths(),
            UtilityPayloadMotherObject::aCustomUtilityBilledEveryMonth(),
        ];

        // Expects
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Two utilities of the same name: CUSTOM_76aeab63a36298ab54940aa1b9114b6a)');

        // When
        Utilities::ofPayload($payload);
    }
}
