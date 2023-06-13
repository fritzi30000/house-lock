<?php

declare(strict_types=1);

namespace HouseLock\FlatRent\Domain;

use HouseLock\FlatRent\Domain\Exception\PersonException;

final class PersonId
{
    private readonly string $value;

    public function __construct(string $value, private readonly PersonIdType $personIdType)
    {
        if (empty($value)) {
            throw PersonException::personIdValueCannotBeEmpty();
        }
        $this->value = $value;
    }

    public function equals(PersonId $id): bool
    {
        return $this->value === $id->value && $this->personIdType === $id->personIdType;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function getPersonIdType(): PersonIdType
    {
        return $this->personIdType;
    }

    public function serialize(): string
    {
        return "{$this->personIdType->value} $this->value";
    }
}
