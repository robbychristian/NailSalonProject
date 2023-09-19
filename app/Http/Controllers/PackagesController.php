<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePackagesRequest;
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
            'price' => $request->price
        ]);


        // $user = User::find($userId); // Replace with how you get the user
        // $user->permissions()->sync($request->input('permissions', []));

        foreach ($request->product as $product) {
            PackageProducts::create([
                'package_id' => $package->id,
                'product_id' => $product
            ]);
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
        $package = Packages::find($id);
        // $packagesProducts = DB::table('package_products')
        //     ->where('package_id', $package->id)
        //     ->get();
        // return $package->packageProducts;
        // // dd($package->products);
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
    public function update(CreatePackagesRequest $request, $id)
    {
        Packages::where('id', $id)->update([
            'package_name' => $request->package_name,
            'price' => $request->price
        ]);

        $package = Packages::find($id);
        $package->products()->sync($request->product, []);
        // $package->update()

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
        //
    }
}
