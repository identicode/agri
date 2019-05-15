<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\User;
use App\Question;

use Hash;

class ForgotController extends Controller
{
    public function form()
    {
    	return view('auth.forgot.search');
    }

    public function search(Request $request)
    {
    	$find = User::where('username', $request->username)->count();

    	if($find == 1){
    		$user =  User::where('username', $request->username)->get()->first();
    		$user_id = $user->id;
    		return view('auth.forgot.security')->with('user_id', $user_id);
    	}else{
    		return redirect()->back()->with('error', 'Username not found');
    	}
    	
    }

    public function security(Request $request)
    {
    	$question = Question::where('user_id', $request->uid)->where('question', $request->question)->get()->first();
    	if($question->answer == $request->answer){
    		return view('auth.forgot.change')->with('user', $request->uid);
    	}else{
    		return redirect('/login')->with('error', 'Security question failed. Unable to recover your password.');
    	}
    }


    public function change(Request $request)
    {
    	$user = User::find($request->uid);
        $user->password = Hash::make($request->pass);
        $user->save();

        return redirect('/login')->with('error', 'Password has been changed.');
    }
}
