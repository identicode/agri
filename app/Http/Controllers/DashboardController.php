<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Seller;
use App\Producer;
use App\Dealer;
use App\Product;

class DashboardController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');
    }

    public function index()
    {
    	$count['seller'] = Seller::all()->count();
    	$count['producer'] = Producer::all()->count();
    	$count['dealer'] = Dealer::all()->count();
    	$count['product'] = Product::all()->count();

    	return view('dashboard')
    			->with('count', $count);
    }
}
