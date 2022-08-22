<?php

declare(strict_types=1);

namespace HouseLock\Flat\Domain\Flat\UtilityBillingConfig;

use HouseLock\Shared\TimeInterval;

final class BillingPeriod implements \JsonSerializable
{
    public const START_AT_DAY = 'startAtDay';
    public const TIME_INTERVAL = 'timeInterval';

    public function __construct(private readonly int $startAtDay, private readonly TimeInterval $interval)
    {
    }

    public static function ofPayload(array $payload): self
    {
        return new self(
            (int)$payload[self::START_AT_DAY],
            TimeInterval::ofPayload($payload[self::TIME_INTERVAL])
        );
    }

    public function jsonSerialize(): mixed
    {
        return [
            self::START_AT_DAY => $this->startAtDay,
            self::TIME_INTERVAL => $this->interval->jsonSerialize()
        ];
    }


}