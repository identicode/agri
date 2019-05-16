<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Category;
use App\Product;
use App\Producer;
use App\Ptp;

class ProducerController extends Controller
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
        $producers = Producer::all();
        return view('producer.index')
                ->with('producers', $producers)
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
        return view('producer.add')
                ->with('categories', $categories)
                ->with('products', $products);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $seller = Producer::create([
            'fname' => $request->fname,
            'lname' => $request->lname,
            'mname' => $request->mname,
            'birth' => $request->bday,
            'age' => $request->age,
            'gen' => $request->gender,
            'civil' => $request->civil,
            'address' => $request->address,
            'cp' => $request->cp,
            'farm' => $request->farm,
            'category_id' => $request->category
        ]);

        foreach($request->product as $product){
            Ptp::create([
                'producer_id' => $seller->id,
                'product_id' => $product

            ]);
        }

        return redirect()->back()->with('success', 'Producer has been added.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $producer = Producer::find($id);
        $categories = Category::all();
        $products = Product::all();

        $ptp = Ptp::where('producer_id', $id)->get();

        $ptpa = array();

        foreach($ptp as $pt){
            $ptpa[] = $pt->product_id;
        }



        return view('producer.view')
                ->with('producer', $producer)
                ->with('ptpa', $ptpa)
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
        $producer = Producer::find($id);
        $categories = Category::all();
        $products = Product::all();

        $ptp = Ptp::where('producer_id', $id)->get();

        $ptpa = array();

        foreach($ptp as $pt){
            $ptpa[] = $pt->product_id;
        }



        return view('producer.edit')
                ->with('producer', $producer)
                ->with('ptpa', $ptpa)
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
        $producer = Producer::find($id);

        Ptp::where('producer_id', $id)->delete();

        $producer->fname = $request->fname;
        $producer->lname = $request->lname;
        $producer->mname = $request->mname;
        $producer->age = $request->age;
        $producer->gen = $request->gender;
        $producer->birth = $request->bday;
        $producer->address = $request->address;
        $producer->civil = $request->civil;
        $producer->cp = $request->cp;
        $producer->farm = $request->farm;
        $producer->category_id = $request->category;

        $producer->save();

        foreach($request->product as $product){
            Ptp::create([
                'producer_id' => $id,
                'product_id' => $product

            ]);
        }


        return redirect('/producer/list')->with('success', 'Producer has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Producer::find($id)->delete();
        Ptp::where('producer_id', $id)->delete();

        return redirect()->back()->with('success', 'Producer has beed deleted.');
    }
}
