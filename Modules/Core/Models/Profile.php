<?php

namespace Corvus\Core\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

 
class Profile extends Model
{
    protected $table = "account_profiles";
    
    protected $fillable = ['user_id','stock_group_id', 'pricing_group_id', 'warehouse_id'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function stock_group()
    {
        return $this->belongsTo(StockGroup::class);
    }
 
    public function pricing_group()
    {
        return $this->belongsTo(PricingGroup::class);
    }

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }    

    public function getStockGroupNameAttribute()
    {
        if ($this->stock_group){
            return $this->name;
        }
        return '';
    }
}