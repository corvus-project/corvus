<?php

namespace App\Http\Resources;
 
use Illuminate\Http\Resources\Json\JsonResource;

class Products extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
          
        return [
            'name' => $this->name,
            'sku' => $this->sku,
            'amount' => $this->amount,
            'quantity' => $this->quantity,
            'warehouse_name' => $this->warehouse_name,
        ];
    }
}
