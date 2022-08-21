<?php

declare(strict_types=1);

namespace HouseLock\Shared;

final class PersonContact
{
    public function __construct(
        public readonly string $firstName,
        public readonly string $lastName,
        public readonly PhoneNumber $phoneNumber,
        public readonly Email $email
    ) {
    }
}