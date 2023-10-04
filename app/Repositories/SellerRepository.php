<?php

namespace App\Repositories;

use App\Models\Seller;

class SellerRepository
{
    public function create(array $data) : Seller
    {
        return Seller::create($data);
    }


    public function getAll()
    {
        return Seller::all();
    }

    public function getById($id)
    {
        return Seller::find($id);
    }
}
