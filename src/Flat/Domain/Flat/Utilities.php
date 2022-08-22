<?php

declare(strict_types=1);

namespace HouseLock\Flat\Domain\Flat;

final class Utilities implements \JsonSerializable
{
    /**
     * @param UtilityBillingConfig[] $list
     */
    public function __construct(private readonly array $list)
    {
    }

    public static function ofPayload(array $payload): self
    {
        $utilitiesList = [];

        foreach ($payload as $payloadItem) {
            $utility = UtilityBillingConfig::ofPayload($payloadItem);

            if (isset($utilitiesList[$utility->getId()])) {
                throw new \InvalidArgumentException("Two utilities of the same name: {$utility->getId()})");
            }
            $utilitiesList[$utility->getId()] = $utility;
        }

        return new self($utilitiesList);
    }

    public function equals(Utilities $utilities): bool
    {
        return $this->jsonSerialize() === $utilities->jsonSerialize();
    }

    public function jsonSerialize(): array
    {
        $serialized = [];
        foreach ($this->list as $utility) {
            $serialized[] = $utility->jsonSerialize();
        }
        return $serialized;
    }
}