<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProductAddOnsRequest;
use App\Models\ProductAddOns;
use App\Models\Products;
use Illuminate\Http\Request;

class ProductAddOnsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product_add_ons = ProductAddOns::all();
        return view('modules.products_addons.index', compact('product_add_ons'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Products::all();
        return view('modules.products_addons.create', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateProductAddOnsRequest $request)
    {
        $addons = ProductAddOns::create([
            'product_id' => $request['product_id'],
            'additional' => $request['additional'],
            'additional_price' => $request['additional_price'],
        ]);

        $addons->newActivity("Product Add Ons Created", "created");
        return redirect('/product-add-ons')->with('success', 'You have successfully added a product add ons!');
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
        $product_add_on = ProductAddOns::find($id);
        $products = Products::all();
        return view('modules.products_addons.edit', compact('product_add_on', 'products'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CreateProductAddOnsRequest $request, $id)
    {
        $addons = ProductAddOns::find($id);

        ProductAddOns::where('id', $id)->update([
            'product_id' => $request['product_id'],
            'additional' => $request['additional'],
            'additional_price' => $request['additional_price'],
        ]);

        $addons->newActivity("Product Add Ons Edited", "Edited");
        return redirect('/product-add-ons')->with('success', 'You have successfully edited a product add ons!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $addons = ProductAddOns::find($id);
        $addons->delete();
        $addons->newActivity("Product Add Ons Deleted", "deleted");
        return redirect('/product-add-ons')->with('success', 'You have successfully deleted a product add ons!');
    }
}
