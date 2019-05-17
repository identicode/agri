<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dtp extends Model
{
    protected $fillable = ['dealer_id', 'product_id'];

    public function product()
    {
    	return $this->belongsTo('App\Product', 'product_id');
    }
}
