<?php

namespace HouseLock\Tests\Flat\Application\Flat;

use HouseLock\Flat\Application\FlatException;
use HouseLock\Flat\Application\Service\FlatServiceImpl;
use HouseLock\Flat\Application\TenantishService;
use HouseLock\Flat\Infrastructure\FlatInMemoryRepository;
use HouseLock\Tests\Flat\Application\Command\CreateFlatObjectMother;
use PHPUnit\Framework\TestCase;

/**
 * @covers \HouseLock\Flat\Application\Service\FlatServiceImpl
 */
class FlatServiceImplTest extends TestCase
{
    /**
     * @test
     */
    public function should_create_flat(): void
    {
        // Given
        $userId = 1;
        $flatPayload = CreateFlatObjectMother::aDefaultFlat();
        $flatRepository = new FlatInMemoryRepository();
        $service = new FlatServiceImpl($flatRepository, $this->createMock(TenantishService::class));

        // When
        $result = $service->create($userId, $flatPayload);

        //Then
        self::assertSame(0, $result->id);
    }

    /**
     * @test
     */
    public function should_not_create_flat_because_it_already_exists_under_address(): void
    {
        // Given
        $userId = 1;
        $flatPayload = CreateFlatObjectMother::aDefaultFlat();
        $flatRepository = new FlatInMemoryRepository();
        $service = new FlatServiceImpl($flatRepository, $this->createMock(TenantishService::class));
        $service->create($userId, $flatPayload);

        // Expects
        $this->expectException(FlatException::class);
        $this->expectExceptionMessage(
            "You have already added flat under such address: {$flatPayload->address->toString()}"
        );

        // When
        $service->create($userId, $flatPayload);
    }

    /**
     * @test
     */
    public function should_update_flat(): void
    {
        // Expects

        // Given

        // When

        //Then

    }

    /**
     * @test
     */
    public function should_not_update_non_existing_flat(): void
    {
        // Expects

        // Given

        // When

        //Then

    }

    /**
     * @test
     */
    public function should_update_flats_address(): void
    {
        // Expects

        // Given

        // When

        //Then

    }

    /**
     * @test
     */
    public function should_not_update_flats_address_if_other_flat_with_the_same_address_exists(): void
    {
        // Expects

        // Given

        // When

        //Then

    }

    /**
     * @test
     */
    public function should_update_flats_capacity(): void
    {
        // Expects

        // Given

        // When

        //Then

    }

    /**
     * @test
     */
    public function should_not_set_flat_capacity_less_than_current_number_of_tenants(): void
    {
        // Expects

        // Given

        // When

        //Then

    }

    /**
     * @test
     */
    public function should_update_flats_deposit(): void
    {
        // Expects

        // Given

        // When

        //Then

    }

    /**
     * @test
     */
    public function should_update_flats_utility_config(): void
    {
        // Expects

        // Given

        // When

        //Then

    }

    /**
     * @test
     */
    public function should_delete_flats(): void
    {
        // Expects

        // Given

        // When

        //Then

    }

    /**
     * @test
     */
    public function should_not_delete_occupied_flat(): void
    {
        // Expects

        // Given

        // When

        //Then

    }

}
