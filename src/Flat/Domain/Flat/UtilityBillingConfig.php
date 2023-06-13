<?php

declare(strict_types=1);

namespace HouseLock\Flat\Domain\Flat;

use HouseLock\Flat\Domain\Flat\UtilityBillingConfig\BillingPeriod;
use HouseLock\Flat\Domain\Flat\UtilityBillingConfig\BillingPeriodSettlementStrategy;
use HouseLock\Flat\Domain\Flat\UtilityBillingConfig\SettlementStrategyFactory;
use JsonSerializable;

final class UtilityBillingConfig implements JsonSerializable
{
    public const TYPE = 'type';
    public const PERIOD = 'period';
    public const SETTLEMENT_STRATEGY = 'settlementStrategy';
    public const NAME = 'name';

    public function __construct(
        public readonly UtilityType $type,
        public readonly BillingPeriod $period,
        public readonly BillingPeriodSettlementStrategy $settlementStrategy,
        public readonly ?string $name = null
    ) {
    }

    public static function ofPayload(array $payload): self
    {
        return new self(
            UtilityType::from($payload[self::TYPE]),
            BillingPeriod::ofPayload($payload[self::PERIOD]),
            SettlementStrategyFactory::ofPayload($payload[self::SETTLEMENT_STRATEGY]),
            $payload[self::NAME] ?? null
        );
    }

    public function getId(): string
    {
        if ($this->type === UtilityType::CUSTOM) {
            return $this->type->name . '_' . md5($this->name);
        }

        return $this->type->name;
    }

    public function jsonSerialize(): array
    {
        return [
            self::TYPE => $this->type->name,
            self::PERIOD => $this->period->jsonSerialize(),
            self::SETTLEMENT_STRATEGY => $this->settlementStrategy->serialize(),
            self::NAME => $this->name,
        ];
    }
}
