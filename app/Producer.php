<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producer extends Model
{
    protected $fillable = [
    	'fname',
    	'lname',
    	'mname',
    	'gen',
    	'birth',
    	'address',
    	'civil',
    	'cp',
        'farm',
        'img',
    	'fimg'
    ];

    public function category()
    {
        return $this->hasMany('App\Ptc', 'producer_id');
    }

    public function product()
    {
        return $this->hasMany('App\Ptp', 'producer_id');
    }
}
