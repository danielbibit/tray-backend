<?php

namespace App\Repositories;

use App\Models\Sale;

class SaleRepository
{
    public function create(array $data) : Sale
    {
        return Sale::create($data);
    }


    public function getAll()
    {
        return Sale::all();
    }

    public function getSalesByDate($date)
    {
        return Sale::selectRaw('*')->whereDate('sale_date', $date)->get();
    }

}
