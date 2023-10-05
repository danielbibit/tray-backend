<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Services\SellerService;
use App\Repositories\SellerRepository;
use App\Models\Seller;

class SellerServiceTest extends TestCase
{
    public function test_seller_email_validation(): void
    {
        $sellerRepositoryMock = $this->createMock(SellerRepository::class);

        // $sellerRepositoryMock->expects($this->once())->method('create')->willReturn(Seller::factory()->make());
        $sellerRepositoryMock->method('create')->willReturn(Seller::factory()->make());
        $sellerService = new SellerService($sellerRepositoryMock);

        // echo "mock created";
        try {
            $sellerService->create([
                'name' => 'John Doe',
                'email' => 'test'
            ]);

            $this->fail('Validation should fail');
        }catch( \ErrorException $e) {
            $this->assertEquals('The email field must be a valid email address.', $e->getMessage());
        }


    }

    public function test_seller_name_validation(): void
    {
        $sellerRepositoryMock = $this->createMock(SellerRepository::class);

        // $sellerRepositoryMock->expects($this->once())->method('create')->willReturn(Seller::factory()->make());
        $sellerRepositoryMock->method('create')->willReturn(Seller::factory()->make());
        $sellerService = new SellerService($sellerRepositoryMock);

        // echo "mock created";
        try {
            $sellerService->create([
                'name' => 'Jo',
                'email' => 'test@test.com'
            ]);

            $this->fail('Validation should fail');
        }catch( \ErrorException $e) {
            $this->assertEquals('The name field must be at least 3 characters.', $e->getMessage());
        }


    }
}
