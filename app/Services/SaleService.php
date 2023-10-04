<?php

namespace App\Services;

use App\Models\Sale;
use App\Repositories\SaleRepository;
use ErrorException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class SaleService
{

    public function __construct(
        private SaleRepository $saleRepository)
    {
        //
    }

    public function create(array $data): Sale
    {
        Log::debug('Creating sale with data: ' . json_encode($data));

        $validationRules = [
            'seller_id' => 'required|integer|exists:App\Models\Seller,id',
            'price' => 'required|decimal:2',
            'sale_date' => 'required|date'
        ];

        $validator = Validator::make($data, $validationRules);

        if($validator->fails()) {
            $errorMessage = $validator->errors()->first();

            throw new ErrorException($errorMessage);
        }

        // Calculate comission
        $data['comission'] = $data['price'] * env('COMISSION_PERCENTAGE');

        return $this->saleRepository->create($data);
    }

    public function getAll()
    {
        return $this->saleRepository->getAll();
    }
}
