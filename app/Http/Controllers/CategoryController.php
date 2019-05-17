<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Category;
use App\Log;

use Auth;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        return view('category.index')
                ->with('categories', $categories);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $check = Category::where('name', $request->category)->get()->count();

        if($check != 0){
            return redirect()->back()->with('error', 'Category already added.');
        }

        Category::create([
            'name' => $request->category
        ]);

        Log::create([
            'user_id' => Auth::user()->id,
            'action' => 'Create category - '.$request->category,
            'ip' => $request->getClientIp()
        ]);

        return redirect()->back()->with('success', 'Category has been added.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $update = Category::find($request->cid);
        $update->name = $request->name;
        $update->save();

        Log::create([
            'user_id' => Auth::user()->id,
            'action' => 'Update category - '.$request->name,
            'ip' => $request->getClientIp()
        ]);

        return redirect()->back()->with('success', 'Category has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cat = Category::find($id);

        Log::create([
            'user_id' => Auth::user()->id,
            'action' => 'Delete category - '.$cat->name,
            'ip' => $request->getClientIp()
        ]);

        $cat->delete();

        return redirect()->back()->with('success', 'Category has been deleted.');
    }
}
