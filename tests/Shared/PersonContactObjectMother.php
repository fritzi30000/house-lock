<?php

declare(strict_types=1);

namespace HouseLock\Tests\Shared;

use HouseLock\Shared\Email;
use HouseLock\Shared\PersonContact;
use HouseLock\Shared\PhoneNumber;

final class PersonContactObjectMother
{

    public static function aJohnSmith(): PersonContact
    {
        return new PersonContact(
            'John',
            'Smith',
            new PhoneNumber('+48666000666'),
            new Email('some@email.com')
        );
    }

    public static function aKarenSmith(): PersonContact
    {
        return new PersonContact(
            'Karen',
            'Smith',
            new PhoneNumber('+48333555333'),
            new Email('other@email.com')
        );
    }

    public static function aPaulJumper(): PersonContact
    {
        return new PersonContact(
            'Paul',
            'Jumper',
            new PhoneNumber('+44666000666'),
            new Email('paul.jumper@email.com')
        );
    }
}