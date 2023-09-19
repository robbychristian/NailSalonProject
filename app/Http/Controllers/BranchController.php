<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateBranchRequest;
use App\Models\Branches;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $branches = Branches::all();
        return view('modules.branch.index', compact('branches'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('modules.branch.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateBranchRequest $request)
    {
        Branches::create([
            'branch_address' => $request['branch_address']
        ]);

        return redirect('/branches')->with('success', 'You have successfully added a branch!');
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
        $branch = Branches::find($id);
        return view('modules.branch.edit', compact('branch'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CreateBranchRequest $request, $id)
    {
        Branches::where('id', $id)->update([
            'branch_address' => $request['branch_address']
        ]);

        return redirect('/branches')->with('success', 'You have successfully edited a branch!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Branches::find($id)->delete();
        return redirect('/branches')->with('success', 'You have successfully deleted a branch!');
    }
}
