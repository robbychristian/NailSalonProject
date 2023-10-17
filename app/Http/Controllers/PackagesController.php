<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePackagesRequest;
use App\Http\Requests\UpdatePackagesRequest;
use App\Models\PackageProducts;
use App\Models\Packages;
use App\Models\Products;
use App\Models\Services;
use Facade\Ignition\Support\Packagist\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PackagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $packages = Packages::all();
        return view('modules.packages.index', compact('packages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $services = Services::all();
        $products = Products::all();
        return view('modules.packages.create', compact('products', 'services'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePackagesRequest $request)
    {
        $package = Packages::create([
            'package_name' => $request->package_name,
            'package_description' => $request->package_description,
            'price' => $request->price
        ]);

        foreach ($request->product as $product) {
            $package->products()->attach($product);
        }

        return redirect('/packages')->with('success', 'You have successfully added a package!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $package = Packages::with('products')->find($id);
        return view('modules.packages.show', compact('package'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $package = Packages::with('products')->find($id);
        $services = Services::all();
        $products = Products::all();
        return view('modules.packages.edit', compact('products', 'services', 'package'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePackagesRequest $request, $id)
    {
        Packages::where('id', $id)->update([
            'package_name' => $request->package_name,
            'package_description' => $request->package_description,
            'price' => $request->price
        ]);

        $package = Packages::find($id);
        $package->products()->sync($request->product);
        return redirect('/packages')->with('success', 'You have successfully edited a package!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $package = Packages::find($id);
        $package->delete();
        $package->products()->detach();

        return redirect('/packages')->with('success', 'You have successfully deleted the package!');
    }
}
