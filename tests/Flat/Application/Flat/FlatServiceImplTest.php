<?php

namespace HouseLock\Tests\Flat\Application\Flat;

use HouseLock\Flat\Application\FlatException;
use HouseLock\Flat\Application\Service\FlatServiceImpl;
use HouseLock\Flat\Infrastructure\FlatInMemoryRepository;
use HouseLock\Tests\Flat\Application\Command\CreateFlatObjectMother;
use PHPUnit\Framework\TestCase;

class FlatServiceImplTest extends TestCase
{
    public function testShouldCreateFlat(): void
    {
        // Given
        $userId = 1;
        $flatPayload = CreateFlatObjectMother::aDefaultFlat();
        $flatRepository = new FlatInMemoryRepository();
        $service = new FlatServiceImpl($flatRepository);

        // When
        $result = $service->create($userId, $flatPayload);

        //Then
        self::assertSame(0, $result->id);
    }

    public function testShouldNotCreateFlatBecauseItAlreadyExistsUnderAddress(): void
    {
        // Given
        $userId = 1;
        $flatPayload = CreateFlatObjectMother::aDefaultFlat();
        $flatRepository = new FlatInMemoryRepository();
        $service = new FlatServiceImpl($flatRepository);
        $service->create($userId, $flatPayload);

        // Expects
        $this->expectException(FlatException::class);
        $this->expectExceptionMessage("You have already added flat under such address: {$flatPayload->address->toString()}");

        // When
        $service->create($userId, $flatPayload);
    }
}
