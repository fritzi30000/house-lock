<?php

declare(strict_types=1);

namespace HouseLock\Flat\Domain\Flat\UtilityBillingConfig;

interface BillingPeriodSettlementStrategy
{
    public const TYPE = 'type';

    public static function ofPayload(array $payload): BillingPeriodSettlementStrategy;

    public function getType(): SettlementType;

    public function serialize(): array;
}
