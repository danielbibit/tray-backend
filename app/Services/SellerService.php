<?php

namespace App\Services;

use App\Models\Seller;
use App\Repositories\SellerRepository;
use ErrorException;
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

    public function getAll()
    {
        return $this->sellerRespository->getAll();
    }
}
