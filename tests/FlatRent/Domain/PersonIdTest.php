<?php

namespace HouseLock\Tests\FlatRent\Domain;

use HouseLock\FlatRent\Domain\Exception\PersonException;
use HouseLock\FlatRent\Domain\PersonId;
use HouseLock\FlatRent\Domain\PersonIdType;
use PHPUnit\Framework\TestCase;

/**
 * @covers \HouseLock\FlatRent\Domain\PersonId
 */
class PersonIdTest extends TestCase
{
    public function testShouldCreatePersonId(): void
    {
        // When
        $personId = PersonIdObjectMother::idCard();

        //Then
        self::assertTrue($personId->equals(PersonIdObjectMother::idCard()));
    }

    public function testShouldNotCreatePersonIdBecauseValueIsEmpty(): void
    {
        // Expects
        $this->expectException(PersonException::class);
        $this->expectExceptionMessage('Person ID value cannot be empty');

        // When
        new PersonId('', PersonIdType::PASSPORT);
    }
}
