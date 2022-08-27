<?php

namespace HouseLock\Tests\Shared;

use Carbon\Carbon;
use HouseLock\Shared\SystemConstants;
use HouseLock\Shared\TimeInterval;
use PHPUnit\Framework\TestCase;

/**
 * @covers \HouseLock\Shared\TimeInterval
 */
class TimeIntervalTest extends TestCase
{

    /**
     * @param array $payload
     * @param Carbon $expectedDate
     * @return void
     * @dataProvider timeIntervals
     */
    public function testShouldCreateTimeInterval(array $payload, Carbon $expectedDate): void
    {
        // Given
        $currentDate = Carbon::createFromFormat(SystemConstants::DEFAULT_DATETIME_FORMAT, '2022-10-08 00:00:00');
        $timeInterval = TimeInterval::ofPayload($payload);

        // When
        $nextDate = $timeInterval->next($currentDate);

        //Then
        self::assertSame($expectedDate->format(SystemConstants::DEFAULT_DATETIME_FORMAT),
            $nextDate->format(SystemConstants::DEFAULT_DATETIME_FORMAT));
    }

    public function timeIntervals(): array
    {
        return [
            [
                TimeIntervalMotherObject::everyMonth(),
                Carbon::createFromFormat(SystemConstants::DEFAULT_DATETIME_FORMAT, '2022-11-08 00:00:00')
            ],
            [
                TimeIntervalMotherObject::everyTwoMonths(),
                Carbon::createFromFormat(SystemConstants::DEFAULT_DATETIME_FORMAT, '2022-12-08 00:00:00')
            ],
            [
                TimeIntervalMotherObject::everyThreeMonths(),
                Carbon::createFromFormat(SystemConstants::DEFAULT_DATETIME_FORMAT, '2023-01-08 00:00:00')
            ],
            [
                TimeIntervalMotherObject::everyThreeWeeks(),
                Carbon::createFromFormat(SystemConstants::DEFAULT_DATETIME_FORMAT, '2022-10-29 00:00:00')
            ]
        ];
    }
}
