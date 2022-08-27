<?php

declare(strict_types=1);

namespace HouseLock\Tests\FlatRent\Domain;

use HouseLock\FlatRent\Domain\PersonId;
use HouseLock\FlatRent\Domain\PersonIdType;

final class PersonIdObjectMother
{
    public static function idCard(): PersonId
    {
        return new PersonId('AVM542435', PersonIdType::ID_CARD);
    }

    public static function passport(): PersonId
    {
        return new PersonId('EB45356', PersonIdType::PASSPORT);
    }

    public static function passport2(): PersonId
    {
        return new PersonId('YB44356', PersonIdType::PASSPORT);
    }
}