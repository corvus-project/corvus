<?php

namespace Corvus\Core\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

 
class Product extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'products';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'sku', 'description'];
  
    public function pricing()
    {
        return $this->hasMany(Pricing::class);
    }

    public function stocks()
    {
        return $this->hasMany(Stock::class);
    }    

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'product_categories')->withPivot(['product_id', 'category_id'])
        ->withTimestamps();
    }    
}