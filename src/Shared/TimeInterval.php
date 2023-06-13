<?php

declare(strict_types=1);

namespace HouseLock\Shared;

use Carbon\Carbon;
use Carbon\CarbonInterval;
use JsonSerializable;

final class TimeInterval implements JsonSerializable
{
    public const INTERVAL = 'interval';
    public const TYPE = 'type';

    public function __construct(public readonly int $interval, public readonly TimeIntervalType $intervalType)
    {
    }

    public static function ofPayload(array $payload): self
    {
        return new self((int) $payload[self::INTERVAL], TimeIntervalType::from($payload[self::TYPE]));
    }

    public function next(Carbon $date): Carbon
    {
        $carbonInterval = CarbonInterval::make($this->interval, $this->intervalType->name);
        $date->add($carbonInterval);

        return $date;
    }

    public function jsonSerialize(): array
    {
        return [
            self::INTERVAL => $this->interval,
            self::TYPE => $this->intervalType->name,
        ];
    }
}
