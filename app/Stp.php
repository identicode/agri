<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stp extends Model
{
    protected $fillable = ['seller_id', 'product_id'];

    public function product()
    {
    	return $this->belongsTo('App\Product', 'product_id');
    }
}
