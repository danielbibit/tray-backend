<?php

namespace App\Repositories;

use App\Models\Sale;
use Illuminate\Database\Eloquent\Collection;

class SaleRepository
{
    public function create(array $data) : Sale
    {
        return Sale::create($data);
    }


    public function getAll() : Collection
    {
        return Sale::all();
    }

    public function getSalesByDate(string $date) : Collection
    {
        return Sale::selectRaw('*')->whereDate('sale_date', $date)->get();
    }

}
