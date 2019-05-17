<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Seller extends Model
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
    	'dealer_id',
        'img'
    ];

    public function category()
    {
        return $this->hasMany('App\Stc', 'seller_id');
    }

    public function dealer()
    {
        return $this->belongsTo('App\Dealer', 'dealer_id');
    }

    public function product()
    {
        return $this->hasMany('App\Stp', 'seller_id');
    }
}
