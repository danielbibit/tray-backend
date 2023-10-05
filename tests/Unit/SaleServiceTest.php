<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Services\SaleService;
use App\Repositories\SaleRepository;
use App\Models\Sale;

class SaleServiceTest extends TestCase
{
    public function test_sale_service_validation(): void
    {
        $saleRepositoryMock = $this->createMock(SaleRepository::class);

        // $saleRepositoryMock->expects($this->once())->method('create')->willReturn(Seller::factory()->make());
        $saleRepositoryMock->method('create')->willReturn(Sale::factory()->make());
        $saleService = new SaleService($saleRepositoryMock);

        try {
            $saleService->create([
                'seller_id' => 1,
                'price' => 100,
                'sale_date' => '2021-01-01'
            ]);

            $this->fail('Validation should fail');
        }catch( \ErrorException $e) {
            $this->assertEquals('The price field must have 2 decimal places.', $e->getMessage());
        }

        try {
            $saleService->create([
                'seller_id' => 1,
                'price' => '100.00',
                'sale_date' => 'a'
            ]);

            $this->fail('Validation should fail');
        }catch( \ErrorException $e) {
            $this->assertEquals('The sale date field must be a valid date.', $e->getMessage());
        }

        try {
            $saleService->create([
                'seller_id' => 0,
                'price' => '100.00',
                'sale_date' => '2021-01-01'
            ]);

            $this->fail('Validation should fail');
        }catch( \ErrorException $e) {
            $this->assertEquals('The selected seller id is invalid.', $e->getMessage());
        }

    }

}

