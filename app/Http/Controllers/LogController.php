<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Log;

class LogController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
    	$logs = Log::all();

    	return view('settings.logs')
    			->with('logs', $logs);
    }
}
