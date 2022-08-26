<?php

declare(strict_types=1);

namespace HouseLock\FlatRent\Domain;

use HouseLock\Shared\PersonContact;

final class Person
{
    public function __construct(public readonly PersonContact $contact)
    {
    }

    public function equals(Person $person): bool
    {
    }

    public function serialize(): string
    {
    }
}