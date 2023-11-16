<?php

namespace App\Services;

use App\Models\Seller;
use App\Repositories\SellerRepository;
use ErrorException;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class SellerService
{

    public function __construct(
        private SellerRepository $sellerRespository)
    {
        //
    }

    public function create(array $data): Seller
    {
        $validationRules = [
            'name' => 'required|string|min:3|max:50',
            'email' => 'required|email',
        ];

        $validator = Validator::make($data, $validationRules);

        if($validator->fails()) {
            $errorMessage = $validator->errors()->first();

            throw new ErrorException($errorMessage);
        }

        return $this->sellerRespository->create($data);
    }

    public function getAll() : Collection
    {
        return $this->sellerRespository->getAll();
    }

    public function getById(int $id) : Collection
    {
        return $this->sellerRespository->getById($id);
    }

    public function getSales(int $id) : Collection
    {
        $seller = $this->sellerRespository->getById($id);

        if(!$seller) {
            throw new ErrorException('Seller not found');
        }

        return $seller->sales;
    }
}
