<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Seller;
use App\Category;
use App\Product;
use App\Dealer;
use App\Stp;

class SellerController extends Controller
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
        $sellers = Seller::all();
        $categories = Category::all();
        return view('seller.index')
                ->with('sellers', $sellers)
                ->with('categories', $categories);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $products = Product::all();
        $dealers = Dealer::all();
        return view('seller.add')
                ->with('categories', $categories)
                ->with('products', $products)
                ->with('dealers', $dealers);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $seller = Seller::create([
            'fname' => $request->fname,
            'lname' => $request->lname,
            'mname' => $request->mname,
            'birth' => $request->bday,
            'age' => $request->age,
            'gen' => $request->gender,
            'civil' => $request->civil,
            'address' => $request->address,
            'cp' => $request->cp,
            'category_id' => $request->category,
            'dealer_id' => $request->dealer
        ]);

        foreach($request->product as $product){
            Stp::create([
                'seller_id' => $seller->id,
                'product_id' => $product

            ]);
        }

        return redirect()->back()->with('success', 'Seller has been added.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $seller = Seller::find($id);
        $dealers = Dealer::all();
        $categories = Category::all();
        $products = Product::all();

        $stp = Stp::where('seller_id', $id)->get();

        $stpa = array();

        foreach($stp as $st){
            $stpa[] = $st->product_id;
        }



        return view('seller.view')
                ->with('seller', $seller)
                ->with('stpa', $stpa)
                ->with('dealers', $dealers)
                ->with('products', $products)
                ->with('categories', $categories);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $seller = Seller::find($id);
        $dealers = Dealer::all();
        $categories = Category::all();
        $products = Product::all();

        $stp = Stp::where('seller_id', $id)->get();

        $stpa = array();

        foreach($stp as $st){
            $stpa[] = $st->product_id;
        }



        return view('seller.edit')
                ->with('seller', $seller)
                ->with('stpa', $stpa)
                ->with('dealers', $dealers)
                ->with('products', $products)
                ->with('categories', $categories);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $seller = Seller::find($id);

        Stp::where('seller_id', $id)->delete();

        $seller->fname = $request->fname;
        $seller->lname = $request->lname;
        $seller->mname = $request->mname;
        $seller->age = $request->age;
        $seller->gen = $request->gender;
        $seller->birth = $request->bday;
        $seller->address = $request->address;
        $seller->civil = $request->civil;
        $seller->cp = $request->cp;
        $seller->category_id = $request->category;
        $seller->dealer_id = $request->dealer;

        $seller->save();

        foreach($request->product as $product){
            Stp::create([
                'seller_id' => $id,
                'product_id' => $product

            ]);
        }


        return redirect('/seller/list')->with('success', 'Seller has been updated.');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Seller::find($id)->delete();
        Stp::where('seller_id', $id)->delete();

        return redirect()->back()->with('success', 'Seller has beed deleted.');
    }
}
