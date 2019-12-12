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

    protected $dates = ['from_date', 'to_date'];

    protected $casts = [
        'from_date' => 'date:d M Y',
        'to_date' => 'date:d M Y',
    ];

    public function stock_type()
    {
        return $this->belongsTo(StockType::class);
    }
 
    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }
    
    public function getFromToAttribute()
    {
        if ($this->from_date || $this->to_date){
            return "from " .(new Carbon($this->from_date))->format('d M Y') . " to ". (new Carbon($this->to_date))->format('d M Y');
        }

        return 'No date limitation';
    }    
 
}
