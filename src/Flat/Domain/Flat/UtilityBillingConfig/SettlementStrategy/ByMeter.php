<?php

declare(strict_types=1);

namespace HouseLock\Flat\Domain\Flat\UtilityBillingConfig\SettlementStrategy;

use HouseLock\Flat\Domain\Flat\UtilityBillingConfig\BillingPeriodSettlementStrategy;
use HouseLock\Flat\Domain\Flat\UtilityBillingConfig\SettlementType;

final class ByMeter implements BillingPeriodSettlementStrategy
{
    public function __construct()
    {
        // todo
        // tariffs, days, nights and so on
//        'tariffs' => [
//            ['price' => 0.43, 'name' => 'day'],
//            ['price' => 0.38, 'name' => 'night']
//        ]
    }

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
        return SettlementType::BY_METER;
    }
}
