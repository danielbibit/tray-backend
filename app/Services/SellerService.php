<?php

namespace App\Services;

use App\Http\Resources\SellerResource;
use App\Models\Seller;
use App\Repositories\SellerRepository;
use ErrorException;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class SellerService
{

    public function __construct(
        private SellerRepository $sellerRespository)
    {
        //
    }

    public function create(array $data): SellerResource
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

        return new SellerResource($this->sellerRespository->create($data));
    }

    public function getAll() : AnonymousResourceCollection
    {
        return SellerResource::collection($this->sellerRespository->getAll());
    }

    public function getById(int $id) : SellerResource
    {
        return new SellerResource($this->sellerRespository->getById($id));
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
