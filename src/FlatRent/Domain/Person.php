<?php

declare(strict_types=1);

namespace HouseLock\FlatRent\Domain;

use HouseLock\Shared\PersonContact;

final class Person
{
    public function __construct(public readonly PersonId $id, public readonly PersonContact $contact)
    {
    }

    public function equals(Person $person): bool
    {
        return $this->id->equals($person->id);
    }

    public function serialize(): string
    {
        return "{$this->id->serialize()}, {$this->contact->serialize()}";
    }
}