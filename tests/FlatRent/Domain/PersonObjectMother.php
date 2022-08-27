<?php

declare(strict_types=1);

namespace HouseLock\Tests\FlatRent\Domain;

use HouseLock\FlatRent\Domain\Person;
use HouseLock\Tests\Shared\PersonContactObjectMother;

final class PersonObjectMother
{

    public static function aJohnSmith(): Person
    {
        return new Person(PersonIdObjectMother::idCard(), PersonContactObjectMother::aJohnSmith());
    }

    public static function aKarenSmith(): Person
    {
        return new Person(PersonIdObjectMother::passport(), PersonContactObjectMother::aKarenSmith());
    }

    public static function aPaulJumper(): Person
    {
        return new Person(PersonIdObjectMother::passport2(), PersonContactObjectMother::aPaulJumper());
    }

}