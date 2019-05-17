<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ptc extends Model
{
    protected $fillable = ['producer_id', 'category_id'];

    public function category()
    {
    	return $this->belongsTo('App\Category', 'category_id');
    }
}
