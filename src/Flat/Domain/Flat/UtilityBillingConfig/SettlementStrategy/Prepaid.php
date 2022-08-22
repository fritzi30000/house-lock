<?php

declare(strict_types=1);

namespace HouseLock\Flat\Domain\Flat\UtilityBillingConfig\SettlementStrategy;

use HouseLock\Flat\Domain\Flat\UtilityBillingConfig\BillingPeriodSettlementStrategy;
use HouseLock\Flat\Domain\Flat\UtilityBillingConfig\SettlementType;
use Money\Currency;
use Money\Money;

final class Prepaid implements BillingPeriodSettlementStrategy
{
    public const PRICE = 'price';
    public const CURRENCY = 'currency';

    public function __construct(private readonly Money $price)
    {
    }

    public static function ofPayload(array $payload): BillingPeriodSettlementStrategy
    {
        return new self(new Money($payload[self::PRICE], new Currency($payload[self::CURRENCY])));
    }

    public function serialize(): array
    {
        return [
            self::TYPE => $this->getType(),
            self::PRICE => $this->price->getAmount(),
            self::CURRENCY => $this->price->getCurrency()->getCode(),
        ];
    }

    public function getType(): SettlementType
    {
        return SettlementType::PREPAID;
    }

}