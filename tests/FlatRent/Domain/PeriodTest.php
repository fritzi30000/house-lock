<?php

namespace HouseLock\Tests\FlatRent\Domain;

use Carbon\Carbon;
use HouseLock\FlatRent\Domain\Period;
use HouseLock\Shared\SystemConstants;
use PHPUnit\Framework\TestCase;

/**
 * @covers \HouseLock\FlatRent\Domain\Period
 */
class PeriodTest extends TestCase
{
    /**
     * @param Carbon $date
     * @param bool $expectedResult
     * @return void
     * @dataProvider dateInPeriodWithEndAt
     */
    public function testShouldCheckIfDateIsInPeriodWithEndAt(Carbon $date, bool $expectedResult): void
    {
        // Given
        $startAt = Carbon::createFromFormat(SystemConstants::DEFAULT_DATE_FORMAT, '2022-04-01');
        $endAt = Carbon::createFromFormat(SystemConstants::DEFAULT_DATE_FORMAT, '2023-03-31');
        $period = new Period($startAt, $endAt);

        // When
        $result = $period->inPeriod($date);

        //Then
        self::assertSame($expectedResult, $result);
    }

    /**
     * @param Carbon $date
     * @param bool $expectedResult
     * @return void
     * @dataProvider dateInPeriodWithoutEndAt
     */
    public function testShouldCheckIfDateIsInPeriodWithoutEndAt(Carbon $date, bool $expectedResult): void
    {
        // Given
        $startAt = Carbon::createFromFormat(SystemConstants::DEFAULT_DATE_FORMAT, '2022-04-01');
        $period = new Period($startAt, null);

        // When
        $result = $period->inPeriod($date);

        //Then
        self::assertSame($expectedResult, $result);
    }

    public function dateInPeriodWithEndAt(): array
    {
        return [
            [Carbon::createFromFormat(SystemConstants::DEFAULT_DATE_FORMAT, '2022-03-31'), false],
            [Carbon::createFromFormat(SystemConstants::DEFAULT_DATE_FORMAT, '2022-04-01'), true],
            [Carbon::createFromFormat(SystemConstants::DEFAULT_DATE_FORMAT, '2022-10-11'), true],
            [Carbon::createFromFormat(SystemConstants::DEFAULT_DATE_FORMAT, '2023-03-31'), true],
            [Carbon::createFromFormat(SystemConstants::DEFAULT_DATE_FORMAT, '2023-04-01'), false],
            [Carbon::createFromFormat(SystemConstants::DEFAULT_DATE_FORMAT, '2024-03-31'), false],
        ];
    }

    public function dateInPeriodWithoutEndAt(): array
    {
        return [
            [Carbon::createFromFormat(SystemConstants::DEFAULT_DATE_FORMAT, '2022-03-31'), false],
            [Carbon::createFromFormat(SystemConstants::DEFAULT_DATE_FORMAT, '2022-04-01'), true],
            [Carbon::createFromFormat(SystemConstants::DEFAULT_DATE_FORMAT, '2022-10-11'), true],
            [Carbon::createFromFormat(SystemConstants::DEFAULT_DATE_FORMAT, '2024-03-31'), true],
        ];
    }

    /**
     * @param Period $period1
     * @param Period $period2
     * @param bool $expectedResult
     * @return void
     * @dataProvider periods
     */
    public function testShouldCheckIfPeriodOverlaps(Period $period1, Period $period2, bool $expectedResult): void
    {
        // When
        $result = $period1->overlaps($period2);

        //Then
        self::assertSame($expectedResult, $result);
    }

    public function periods(): array
    {
        return [
            [PeriodObjectMother::year2020(), PeriodObjectMother::year2021(), false],
            [PeriodObjectMother::year2020(), PeriodObjectMother::yearHalf20202021(), true],
            [PeriodObjectMother::yearHalf20202021(), PeriodObjectMother::year2020(), true],
            [PeriodObjectMother::yearHalf20202021(), PeriodObjectMother::year2021(), true],
            [PeriodObjectMother::year2021(), PeriodObjectMother::yearHalf20202021(), true],
        ];
    }
}
