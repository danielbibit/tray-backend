<?php

namespace App\Services;

use App\Http\Resources\SaleResource;
use App\Models\Sale;
use App\Repositories\SaleRepository;
use ErrorException;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class SaleService
{

    public function __construct(
        private SaleRepository $saleRepository)
    {
        //
    }

    public function create(array $data): SaleResource
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
        $data['comission'] = $data['price'] * config('app.comission_percentage');

        return new SaleResource($this->saleRepository->create($data));
    }
    public function getAll() : AnonymousResourceCollection
    {
        return SaleResource::collection($this->saleRepository->getAll());
    }
}
