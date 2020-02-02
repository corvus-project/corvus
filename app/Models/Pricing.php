<?php

namespace App\Models;


use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

 
class Pricing extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'pricings';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['product_id', 'pricing_group_id', 'amount', 'from_date', 'to_date'];
  
    protected $dateFormat = 'Y-m-d';

    protected $dates = ['from_date', 'to_date'];

    protected $casts = [
        'from_date' => 'date:d M Y',
        'to_date' => 'date:d M Y',
    ];

    public function pricing_group()
    {
        return $this->belongsTo(PricingGroup::class);
    }
     
    public function getFromToAttribute()
    {
        if ($this->from_date || $this->to_date){
            return "from " .(new Carbon($this->from_date))->format('d M Y') . " to ". (new Carbon($this->to_date))->format('d/M/Y');
        }

        return 'No date limitation';
    }    

    public function getFormatFromDateAttribute()
    {
        if ($this->from_date){
            return (new Carbon($this->from_date))->format('Y-m-d');
        }
        return null;
    }

    public function getFormatToDateAttribute()
    {
        if ($this->to_date){
            return (new Carbon($this->to_date))->format('Y-m-d');
        }
        return null;
    }
}