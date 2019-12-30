<?php

namespace App\Models;


use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

 
class StockType extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'stock_types';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [];
 
    public function stocks()
    {
        return $this->hasMany(Stock::class);
    }    
}
