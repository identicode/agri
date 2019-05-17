<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dealer extends Model
{
    protected $fillable = ['name', 'img'];

    public function product()
    {
    	return $this->hasMany('App\Dtp', 'dealer_id');
    }
}
