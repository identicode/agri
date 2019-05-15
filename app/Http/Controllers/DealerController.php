<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Dealer;
use App\Product;

class DealerController extends Controller
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
        $products = Product::all();
        $dealers = Dealer::all();
        return view('dealer.index')
                ->with('dealers', $dealers)
                ->with('products', $products);
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
         Dealer::create([
            'name' => $request->dealer,
            'product_id' => $request->product
        ]);

        return redirect()->back()->with('success', 'Dealer has been added.');
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
        $update = Dealer::find($request->did);
        $update->name = $request->dname;
        $update->product_id = $request->product;
        $update->save();

        return redirect()->back()->with('success', 'Dealer has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Dealer::find($id)->delete();
        return redirect()->back()->with('success', 'Dealer has been deleted.');
    }
}
