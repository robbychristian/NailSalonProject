<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Products;
use App\Models\Services;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Products::all();
        return view('modules.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $services = Services::all();
        return view('modules.products.create', compact('services'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateProductRequest $request)
    {
        $product = Products::create([
            'product_name' => $request['product_name'],
            'product_description' => $request->product_description,
            'service_id' => $request['service_type'],
            'price' => $request['price'],
        ]);

        $product->newActivity("Product Created", "created");
        return redirect('/products')->with('success', 'You have successfully added a product!');
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
        $product = Products::find($id);
        $services = Services::all();
        return view('modules.products.edit', compact('product', 'services'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, $id)
    {
        $product = Products::find($id);
        Products::where('id', $id)->update([
            'product_name' => $request['product_name'],
            'product_description' => $request['product_description'],
            'service_id' => $request['service_type'],
            'price' => $request['price'],
        ]);

        $product->newActivity("Product Edited", "edited");
        return redirect('/products')->with('success', 'You have successfully added a product!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $products = Products::find($id);
        $products->delete();
        $products->package()->detach();

        $products->newActivity("Product Deleted", "deleted");
        return redirect('/products')->with('success', 'You have successfully deleted the product and has been removed from the associated packages!');
    }
}
