<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class OrderLine extends Model
{
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

    public function order_status()
    {
        return $this->belongsTo(OrderStatus::class, 'status', 'id');
    }       
}