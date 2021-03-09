<?php

namespace Corvus\Core\Models;

use Illuminate\Database\Eloquent\Model;

class OrderLine extends Model
{
    protected $fillable = ['product_sku', 'quantity', 'order_header_id', 'status'];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'order_lines';

    public function getStatusValueAttribute()
    {
        return $this->order_status->name;
    }

    public function getOrderIdAttribute()
    {
        if ($this->order) {
            return $this->order->id;
        }
        return 'N/A';
    }

    public function order_status()
    {
        return $this->belongsTo(OrderStatus::class, 'status', 'id');
    }

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_header_id', 'id');
    }
}
