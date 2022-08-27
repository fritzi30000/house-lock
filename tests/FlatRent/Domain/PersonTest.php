<?php

namespace HouseLock\Tests\FlatRent\Domain;

use HouseLock\FlatRent\Domain\Person;
use HouseLock\Tests\Shared\PersonContactObjectMother;
use PHPUnit\Framework\TestCase;

/**
 * @covers \HouseLock\FlatRent\Domain\Person
 */
class PersonTest extends TestCase
{
    public function testShouldCreatePerson(): void
    {
        // When
        $person = new Person(PersonIdObjectMother::idCard(), PersonContactObjectMother::aJohnSmith());

        //Then
        self::assertTrue($person->equals(new Person(PersonIdObjectMother::idCard(),
            PersonContactObjectMother::aJohnSmith())));
        self::assertFalse($person->equals(new Person(PersonIdObjectMother::passport(),
            PersonContactObjectMother::aJohnSmith())));
    }
}
