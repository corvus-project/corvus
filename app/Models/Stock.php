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
    protected $fillable = [];
  
    protected $dateFormat = 'Y-m-d';

    public function stock_type()
    {
        return $this->belongsTo(StockType::class);
    }
 
    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }
}
