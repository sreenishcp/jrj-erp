<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Http\Requests\StoreSupplierRequest;
class SupplierController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $breadcrumbs = [
            ['link' => "modern", 'name' => "Home"], ['link' => "employees", 'name' => "Sapplier"], ['name' => "Supplier List"]];
        $pageConfigs = ['pageHeader' => true, 'isFabButton' => false];

        $QUERY      = Supplier::query();
        $search_status =0;
        if($request->get('search_key')){
            $search_status = 1;
            $search_key=$request->get('search_key');
            $QUERY=$QUERY->where('name', 'LIKE', "%$search_key%")->orWhere('phone','LIKE',"%$search_key%")->orWhere('email','LIKE',"%$search_key%");
        }
        $data['search_status']  = $search_status;
        $data['suppliers']      = $QUERY->where('isDeleted',0)->orderBy('id','desc')->get();
        $data['search_key']     = $request->get('search_key');
        $data['pageConfigs']    = $breadcrumbs;
        $data['breadcrumbs']    = $pageConfigs;
        return view('supplier.list',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $breadcrumbs = [
            ['link' => "modern", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Supplier"], ['name' => "Add Supplier"]];
        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true, 'isFabButton' => false
        ];
        $data['pageConfigs'] = $pageConfigs;
        $data['breadcrumbs'] = $breadcrumbs;
        return view('supplier.add',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSupplierRequest $request)
    {
        $supplier          = new supplier;
        $supplier->name    = $request->name;
        $supplier->phone   = $request->phone;
        $supplier->email   = $request->email;
        $supplier->address = $request->address;
        $supplier->save();
        return redirect('supplier')->withSuccess('Supplier Added Successfully.');;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function show(Supplier $supplier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function edit(Supplier $supplier,$id)
    {
        $breadcrumbs = [
            ['link' => "modern", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Supplier"], ['name' => "Supplier"]];
        $pageConfigs = ['pageHeader' => true, 'isFabButton' => false];
        $data['pageConfigs'] = $pageConfigs;
        $data['breadcrumbs'] = $breadcrumbs;
        $data['supplier']    = Supplier::find($id);
        return view('supplier.add', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Supplier $supplier)
    {
        $supplier          = new supplier;
        $supplier->exists  = true;
        $supplier->id      = $request->id; //already exists in database
        $supplier->name    = $request->name;
        $supplier->phone   = $request->phone;
        $supplier->email   = $request->email;
        $supplier->address = $request->address;
        $supplier->save();
        return redirect('supplier')->withSuccess('Supplier Updated Successfully.');;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function destroy(Supplier $supplier,$id)
    {
        Supplier::where('id',$id)->update(array('isDeleted'=>1));
        return redirect('supplier')->withSuccess('Supplier Deleted Successfully.');;
    }
}
