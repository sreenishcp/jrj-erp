<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use Illuminate\Http\Request;
use App\Http\Requests\StoreBranchesRequest;
use App\Http\Resources\BranchCollection;
class BranchController extends Controller
{
    // public function __construct() {
    //     $this->middleware('auth');
    // }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new BranchCollection(Branch::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $breadcrumbs = [
            ['link' => "modern", 'name' => "Home"], ['link' => "branch", 'name' => "Branch"], ['name' => "Add Branch"]];
        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true, 'isFabButton' => false
        ];
        $data['pageConfigs'] = $pageConfigs;
        $data['breadcrumbs'] = $breadcrumbs;
        return view('branch.add',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBranchesRequest $request)
    {
        $branch                  = new Branch;
        $branch->name            = $request->name;
        $branch->address         = $request->address;
        $branch->status          = 0;
        $branch->phone           = 0;
        $branch->zipcode         = $request->zipcode;
        $branch->save();
        return response()->json('successfully added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function show(Branch $branch)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Branch  $branch
     * @return \Illuminate\Http\Response
     */

        public function edit($id)
        {
          $branch = Branch::find($id);
          return response()->json($branch);
        }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Branch $branch)
    {
        $branch                   = new Branch();
        $branch->exists           = true;
        $branch->id               = $request->id; //already exists in database.
        $branch->name             = $request->name;
        $branch->address          = $request->address;
        $branch->zipcode          = $request->zipcode;
        $branch->phone            = $request->phone;
        $branch->status           = $request->status;
        $branch->save();
        return redirect('branch')->withSuccess( 'Branch Updated Successfully' );;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function destroy(Branch $branch)
    {
        //
    }
}
