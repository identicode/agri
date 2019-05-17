<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Seller;
use App\Category;
use App\Product;
use App\Dealer;
use App\Stp;
use App\Stc;
use App\Log;

use Auth;

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
        // Validating image
        if($request->image == "data:image/jpeg;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wBDAAEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQH/2wBDAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQH/wAARCADIAMgDAREAAhEBAxEB/8QAFQABAQAAAAAAAAAAAAAAAAAAAAv/xAAUEAEAAAAAAAAAAAAAAAAAAAAA/8QAFAEBAAAAAAAAAAAAAAAAAAAAAP/EABQRAQAAAAAAAAAAAAAAAAAAAAD/2gAMAwEAAhEDEQA/AJ/4AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAP//Z"){
           $imageName = 'default.svg';
        }else{
            
            //Image Decoding
            $image = $request->image;
            $image = str_replace('data:image/jpeg;base64,', '', $image);
            $image = str_replace(' ', '+', $image);
            $imageName = mt_rand().time().".jpg";
            $destination = public_path()."/img/avatar/".$imageName;
            $actualImage = base64_decode($image);
            $move = file_put_contents($destination, $actualImage);

        }

        $seller = Seller::create([
            'fname' => $request->fname,
            'lname' => $request->lname,
            'mname' => $request->mname,
            'birth' => $request->bday,
            'gen' => $request->gender,
            'civil' => $request->civil,
            'address' => $request->address,
            'cp' => $request->cp,
            'dealer_id' => $request->dealer,
            'img' => $imageName
        ]);

        foreach($request->product as $product){
            Stp::create([
                'seller_id' => $seller->id,
                'product_id' => $product

            ]);
        }

        foreach($request->category as $category){
            Stc::create([
                'seller_id' => $seller->id,
                'category_id' => $category
            ]);
        }

        Log::create([
            'user_id' => Auth::user()->id,
            'action' => 'Add seller - '.$seller->lname.", ".$seller->fname,
            'ip' => $request->getClientIp()
        ]);

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
        $seller = Seller::with('category.category', 'product.product', 'dealer')->where('id', $id)->get()->first();

        $catarr = array();

        foreach($seller->category as $category){
            $catarr[] = $category->category->name; 
        }

        $prodarr = array();

        foreach($seller->product as $product){
            $prodarr[] = $product->product->name; 
        }


        return view('seller.view')
                ->with('seller', $seller)
                ->with('category', implode(', ', $catarr))
                ->with('product', implode(', ', $prodarr));
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

        $stc = Stc::where('seller_id', $id)->get();

        $stca = array();

        foreach($stc as $sc){
            $stca[] = $sc->category_id;
        }

        


        return view('seller.edit')
                ->with('seller', $seller)
                ->with('stpa', $stpa)
                ->with('stca', $stca)
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

         // check image
        if($request->image == "data:image/jpeg;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wBDAAEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQH/2wBDAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQH/wAARCADIAMgDAREAAhEBAxEB/8QAFQABAQAAAAAAAAAAAAAAAAAAAAv/xAAUEAEAAAAAAAAAAAAAAAAAAAAA/8QAFAEBAAAAAAAAAAAAAAAAAAAAAP/EABQRAQAAAAAAAAAAAAAAAAAAAAD/2gAMAwEAAhEDEQA/AJ/4AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAP//Z"){
           $seller->img = 'default.svg';
        }

        if($request->image != ''){
            //Image Decoding
            $image = $request->image;
            $image = str_replace('data:image/jpeg;base64,', '', $image);
            $image = str_replace(' ', '+', $image);
            $imageName = mt_rand().time().".jpg";
            $destination = public_path()."/img/avatar/".$imageName;
            $actualImage = base64_decode($image);
            $move = file_put_contents($destination, $actualImage);
            $seller->img = $imageName;
        }

        $seller->fname = $request->fname;
        $seller->lname = $request->lname;
        $seller->mname = $request->mname;
        $seller->gen = $request->gender;
        $seller->birth = $request->bday;
        $seller->address = $request->address;
        $seller->civil = $request->civil;
        $seller->cp = $request->cp;
        $seller->dealer_id = $request->dealer;
        

        $seller->save();

        Stp::where('seller_id', $id)->delete();
        Stc::where('seller_id', $id)->delete();

        foreach($request->product as $product){
            Stp::create([
                'seller_id' => $id,
                'product_id' => $product

            ]);
        }

        foreach($request->category as $category){
            Stc::create([
                'seller_id' => $id,
                'category_id' => $category

            ]);
        }

        Log::create([
            'user_id' => Auth::user()->id,
            'action' => 'Update seller - '.$seller->lname.", ".$seller->fname,
            'ip' => $request->getClientIp()
        ]);


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
        $seller = Seller::find($id);
        Stp::where('seller_id', $id)->delete();


        Log::create([
            'user_id' => Auth::user()->id,
            'action' => 'Delete seller - '.$seller->lname.", ".$seller->fname,
            'ip' => $request->getClientIp()
        ]);

        $seller->delete();

        return redirect()->back()->with('success', 'Seller has beed deleted.');
    }
}
