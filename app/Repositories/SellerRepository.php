<?php

namespace App\Repositories;

use App\Models\Seller;
use Illuminate\Database\Eloquent\Collection;

class SellerRepository
{
    public function create(array $data) : Seller
    {
        return Seller::create($data);
    }


    public function getAll() : Collection
    {
        return Seller::all();
    }

    public function getById($id) : Collection
    {
        return Seller::find($id);
    }
}
