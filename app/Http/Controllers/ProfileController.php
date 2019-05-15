<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Question;

use Auth;
use Hash;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
    	return view('settings.profile');
    }

    public function info(Request $request)
    {
    	$update = User::find(Auth::user()->id);
    	$update->fname = $request->fname;
    	$update->lname = $request->lname;
    	$update->mname = $request->mname;
    	$update->save();

    	return redirect()->back()->with('success', 'Profile has been updated.');
    }

    public function avatar(Request $request)
    {
    	// Validating image
        if($request->image == "data:image/jpeg;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wBDAAEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQH/2wBDAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQH/wAARCADIAMgDAREAAhEBAxEB/8QAFQABAQAAAAAAAAAAAAAAAAAAAAv/xAAUEAEAAAAAAAAAAAAAAAAAAAAA/8QAFAEBAAAAAAAAAAAAAAAAAAAAAP/EABQRAQAAAAAAAAAAAAAAAAAAAAD/2gAMAwEAAhEDEQA/AJ/4AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAP//Z"){
            return redirect()->back()->with('error', 'Invalid image file.');
        }

         //Image Decoding
        $image = $request->image;
        $image = str_replace('data:image/jpeg;base64,', '', $image);
        $image = str_replace(' ', '+', $image);
        $imageName = mt_rand().time().".jpg";
        $destination = public_path()."/img/avatar/".$imageName;
        $actualImage = base64_decode($image);
        $move = file_put_contents($destination, $actualImage);

        $update = User::find(Auth::user()->id);
        $update->img = $imageName;
        $update->save();

        return redirect()->back()->with('success', 'Profile avatar has been change.');
    }

    public function username(Request $request)
    {
    	$find = User::where('username', $request->username)
    			->where('id', '!=', Auth::user()->id)
    			->get()
    			->count();

    	if($find != 0){
    		return redirect()->back()->with('error', 'Username is taken.');
    	}

    	$update = User::find(Auth::user()->id);
    	$update->username = $request->username;
    	$update->save();

    	return redirect()->back()->with('success', 'Username has been updated.');


    }

    public function password(Request $request)
    {
    	 // check if match
        if($request->pass != $request->cpass){
            return redirect()->back()->with('error', 'Password mismatch');
        }

        // check if password correct
        if(Hash::check($request->old, Auth::user()->password) == false){
            return redirect()->back()->with('error', 'Incorrect password');
        }

        $update = User::find(Auth::user()->id);

        $update->password = Hash::make($request->pass);
        $update->save();

        return redirect()->back()->with('success', 'Password has been changed.');
    }

    public function question(Request $request)
    {
        $question = Question::where('question', $request->question)->where('user_id', Auth::user()->id)->get()->first();
        $question->answer = $request->answer;
        $question->save();

        return redirect()->back()->with('success', 'Security Question has been updated.');
    }


    public function addAdmin()
    {
        return view('settings.admin');
    }

    public function storeAdmin(Request $request)
    {
        // check if password match
        if($request->pass != $request->cpass){
            return redirect()->back()->withInput()->with('error', 'Password mismatch.');
        }

        // find if username exists
        $checkUsername = User::where('username', $request->username)->get()->count();

        if($checkUsername > 0){
            return redirect()->back()->withInput()->with('error', 'Username is taken.');
        }

        $create = User::create([
            'fname' => $request->fname,
            'lname' => $request->lname,
            'mname' => $request->mname,
            'username' => $request->username,
            'password' => Hash::make($request->pass),
            'img' => 'default.svg'
        ]);

        Question::create([
            'question' => 'What is your mother\'s maiden name?',
            'answer' => '',
            'user_id' => $create->id
        ]);

        Question::create([
            'question' => 'What is the name of your favorite pet?',
            'answer' => '',
            'user_id' => $create->id
        ]);

        Question::create([
            'question' => 'What is your favorite movie?',
            'answer' => '',
            'user_id' => $create->id
        ]);

        return redirect('/settings/account')->with('success', "{$create->fname} {$create->lname} is registered as admin");
    }
}
