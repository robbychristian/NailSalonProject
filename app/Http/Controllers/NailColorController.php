<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateNailColorRequest;
use App\Models\NailColors;
use Illuminate\Http\Request;

class NailColorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $colors = NailColors::all();
        return view('modules.nail-colors.index', compact('colors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('modules.nail-colors.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateNailColorRequest $request)
    {
        $color = NailColors::create([
            'brand' => $request->brand,
            'color' => $request->color
        ]);
        $color->newActivity("Nail Color Created", "created");

        return redirect('/nail-colors')->with('success', 'You have successfully added a nail color!');
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
        $color = NailColors::find($id);
        $color->delete();
        $color->newActivity("Nail Color Deleted", "deleted");

        return redirect('/nail-colors')->with('success', 'You have successfully deleted a color!');
    }
}
