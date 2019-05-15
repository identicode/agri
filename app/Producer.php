<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producer extends Model
{
    protected $fillable = [
    	'fname',
    	'lname',
    	'mname',
    	'age',
    	'gen',
    	'birth',
    	'address',
    	'civil',
    	'cp',
    	'farm',
    	'category_id',
    ];

    public function category()
    {
        return $this->belongsTo('App\Category', 'category_id');
    }

    public function product()
    {
        return $this->hasMany('App\Ptp', 'producer_id');
    }
}
