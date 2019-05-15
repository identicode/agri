<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Seller extends Model
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
    	'category_id',
    	'dealer_id'
    ];

    public function category()
    {
        return $this->belongsTo('App\Category', 'category_id');
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
