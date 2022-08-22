<?php

declare(strict_types=1);

namespace HouseLock\Flat\Domain\Flat\UtilityBillingConfig\SettlementStrategy;

use HouseLock\Flat\Domain\Flat\UtilityBillingConfig\BillingPeriodSettlementStrategy;
use HouseLock\Flat\Domain\Flat\UtilityBillingConfig\SettlementType;

final class Billed implements BillingPeriodSettlementStrategy
{
    public static function ofPayload(array $payload): BillingPeriodSettlementStrategy
    {
        return new self();
    }

    public function serialize(): array
    {
        return [
            self::TYPE => $this->getType(),
        ];
    }

    public function getType(): SettlementType
    {
        return SettlementType::BILLED;
    }

}