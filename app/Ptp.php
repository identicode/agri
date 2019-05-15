<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ptp extends Model
{
    protected $fillable = ['producer_id', 'product_id'];

    public function product()
    {
    	return $this->belongsTo('App\Product', 'product_id');
    }
}
