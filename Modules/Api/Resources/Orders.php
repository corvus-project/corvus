<?php

namespace Corvus\Api\Resources;

use Illuminate\Http\Resources\Json\JsonResource;


class Orders extends JsonResource
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
            'id' => $this->id,
            'ref_id' => $this->ref_id,
            'order_date' => $this->order_date,
            'processed_date' => $this->processed_date,
            'status_name'   => $this->status_value,
            'order_lines' => OrderLines::collection($this->whenLoaded('order_lines')),
        ];
    }
}
