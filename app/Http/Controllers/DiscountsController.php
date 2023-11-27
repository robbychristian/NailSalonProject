<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateDiscountProductRequest;
use App\Http\Requests\CreateDiscountRequest;
use App\Models\Discounts;
use App\Models\Products;
use App\Models\Services;
use Illuminate\Http\Request;

class DiscountsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $discounts = Discounts::with('service')->get();
        // return $discounts;
        return view('modules.discounts.index', compact('discounts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $services = Services::all();
        return view('modules.discounts.create', compact('services'));
    }

    public function createProductDiscounts()
    {
        $products = Products::all();
        return view('modules.discounts.create-products', compact('products'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateDiscountRequest $request)
    {
        // dd($request->all());
        Discounts::create([
            'discount_name' => $request->discount_name,
            'discount_desc' => $request->discount_description,
            'service_id' => $request->service,
            'discount_percent' => $request->discount_percentage
        ]);

        return redirect('/discounts')->with('success', 'You have successfully added a discount!');
    }

    public function storeProductDiscounts(CreateDiscountProductRequest $request)
    {
        // dd($request->all());
        Discounts::create([
            'discount_name' => $request->discount_name,
            'discount_desc' => $request->discount_description,
            'product_id' => $request->product,
            'discount_percent' => $request->discount_percentage
        ]);

        return redirect('/discounts')->with('success', 'You have successfully added a discount!');
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $discount = Discounts::find($id);
        $discount->delete();

        return redirect('/services')->with('success', 'You have successfully deleted the service!');
    }
}
