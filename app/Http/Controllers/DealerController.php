<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Dealer;
use App\Product;

use App\Dtp;

use Auth;

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

        if(Dealer::where('name', $request->dealer)->get()->count() != 0){
            return redirect()->back()->with('error', 'Dealer already added.');
        }

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



        $dealer = Dealer::create([
            'name' => $request->dealer,
            'img' => $imageName
        ]);

        foreach($request->product as $product){
            Dtp::create([
                'dealer_id' => $dealer->id,
                'product_id' => $product
            ]);
        }

        Log::create([
            'user_id' => Auth::user()->id,
            'action' => 'Create dealer - '.$request->dealer,
            'ip' => $request->getClientIp()
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
        Dtp::where('dealer_id', $request->did)->delete();

        $update = Dealer::find($request->did);
        $update->name = $request->dname;
        $update->save();

        Dtp::create([
            'dealer_id' => $update->id,
            'product_id' => $request->product
        ]);

        Log::create([
            'user_id' => Auth::user()->id,
            'action' => 'Update dealer - '.$request->dname,
            'ip' => $request->getClientIp()
        ]);

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
        $dealer = Dealer::find($id);
        Dtp::where('dealer_id', $id)->delete();

        Log::create([
            'user_id' => Auth::user()->id,
            'action' => 'Delete dealer - '.$dealer->name,
            'ip' => $request->getClientIp()
        ]);

        $dealer->delete();

        return redirect()->back()->with('success', 'Dealer has been deleted.');
    }
}
