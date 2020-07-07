<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'order_headers';
 
    protected $fillable = ['user_id', 'order_date', 'status', 'ref_id'];

    protected $dates = ['order_date'];

    public function getStatusValueAttribute()
    {
        return $this->order_status->name;
    }    

    public function getStatusSlugAttribute()
    {
        return $this->order_status->slug;
    }    
 
    public function account()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function order_status()
    {
        return $this->belongsTo(OrderStatus::class, 'status', 'id');
    }    

    public function order_lines()
    {
        return $this->hasMany(OrderLine::class, 'order_header_id', 'id');
    }
}