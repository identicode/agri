<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stc extends Model
{
    protected $fillable = ['seller_id', 'category_id'];

    public function category()
    {
    	return $this->belongsTo('App\Category', 'category_id');
    }
}
