<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

 
class Profile extends Model
{
    protected $table = "account_profiles";
    
    protected $fillable = ['user_id','stock_type_id', 'pricing_group_id', 'warehouse_id'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function stock_type()
    {
        return $this->belongsTo(StockType::class);
    }
 
    public function pricing_group()
    {
        return $this->belongsTo(PricingGroup::class);
    }

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }    

}