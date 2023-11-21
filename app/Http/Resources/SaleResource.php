<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SaleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'price' => $this->price,
            'sale_date' => $this->sale_date,
            'comission' => $this->comission,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'seller_id' => $this->seller_id
        ];
    }
}
