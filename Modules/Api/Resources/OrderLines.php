<?php

namespace Corvus\Api\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderLines extends JsonResource
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
            'product_name' => $this->product_name,
            'product_sku' => $this->product_sku,
            'price' => $this->price,
            'quantity'   => $this->quantity,
            'status'   => $this->status_value,
        ];
    }
}
