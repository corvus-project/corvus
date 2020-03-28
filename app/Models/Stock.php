<?php

namespace App\Models;
 
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
 
class Stock extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'stocks';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['product_id', 'stock_group_id', 'warehouse_id', 'quantity'];
  
    protected $dateFormat = 'Y-m-d';

    public function stock_group()
    {
        return $this->belongsTo(StockGroup::class);
    }
 
    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }

    public function getFormatToDateAttribute()
    {
        return Carbon::parse($this->to_date)->format('Y-m-d');
    }    


    public function getFormatFromDateAttribute()
    {
        return Carbon::parse($this->to_date)->format('Y-m-d');
    }        

}
