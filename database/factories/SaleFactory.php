<?php

namespace Database\Factories;

use App\Models\Seller;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Sale>
 */
class SaleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $salePrice = $this->faker->randomFloat(2, 10, 1000);
        $comission = $salePrice * config('app.comission_percentage');

        return [
            'price' => $salePrice,
            'sale_date' => $this->faker->dateTimeBetween('-3 days', 'now'),
            'comission' => $comission,
            'seller_id' => Seller::factory(),
        ];
    }
}
