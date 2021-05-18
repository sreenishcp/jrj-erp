<?php

namespace App\Http\Controllers;

use App\Models\DeliveryVehicle;
use Illuminate\Http\Request;
use App\Models\Branch;
use App\Http\Requests\storeVehicleRequest;
class DeliveryVehicleController extends Controller
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
            ['link' => "modern", 'name' => "Home"], ['link' => "employees", 'name' => "Deliver Vehicle"], ['name' => "Vehicle List"]];
        $pageConfigs = ['pageHeader' => true, 'isFabButton' => false];

        $QUERY      = DeliveryVehicle::query();
        $search_status  =   0;
        if($request->get('vehicle_type')!=''){
            $QUERY=$QUERY->where('vehicle_type',$request->get('vehicle_type'));
            $search_status  =  1;
        }
        if($request->get('search_key')){
            $search_status  =  1;
            $search_key=$request->get('search_key');
            $QUERY=$QUERY->where('reg_number', 'LIKE', "%$search_key%");
        }
        $data['search_status']  = $search_status;
        $data['vehicles']       = $QUERY->where('isDeleted',0)->orderBy('id','desc')->get();
        $data['search_key']     = $request->get('search_key');
        $data['vehicle_type']   = $request->get('vehicle_type');
        $data['pageConfigs']    = $breadcrumbs;
        $data['breadcrumbs']    = $pageConfigs;
        return view('delivery_vehicle.list',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $breadcrumbs = [
            ['link' => "modern", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Vehicle"], ['name' => "Add Vehicle"]];
        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true, 'isFabButton' => false
        ];
        $data['pageConfigs'] = $pageConfigs;
        $data['breadcrumbs'] = $breadcrumbs;
        $data['branches']    = Branch::orderBy('id')->pluck('name','id');
        return view('delivery_vehicle.add',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(storeVehicleRequest $request)
    {
        $Vehicle                = new DeliveryVehicle;
        $Vehicle->reg_number    = $request->reg_number;
        $Vehicle->vehicle_type  = $request->vehicle_type;
        $Vehicle->branch_id     = $request->branch_id;
        $Vehicle->save();
        return redirect('delivery-vehicle')->withSuccess('Vehicle Added Successfully.');;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DeliveryVehicle  $DeliveryVehicle
     * @return \Illuminate\Http\Response
     */
    public function show(DeliveryVehicle $DeliveryVehicle)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\deliveryVehicle  $deliveryVehicle
     * @return \Illuminate\Http\Response
     */
    public function edit(DeliveryVehicle $DeliveryVehicle,$id)
    {
        $breadcrumbs = [
            ['link' => "modern", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Vehicle"], ['name' => "Vehicle"]];
        $pageConfigs = ['pageHeader' => true, 'isFabButton' => false];
        $data['pageConfigs'] = $pageConfigs;
        $data['breadcrumbs'] = $breadcrumbs;
        $data['vehicle']     = DeliveryVehicle::find($id);
        $data['branches']    = Branch::orderBy('id')->pluck('name','id');
        return view('delivery_vehicle.add', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\deliveryVehicle  $deliveryVehicle
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DeliveryVehicle $DeliveryVehicle)
    {
        $Vehicle                = new DeliveryVehicle;
        $Vehicle->exists        = true;
        $Vehicle->id            = $request->id; //already exists in database
        $Vehicle->reg_number    = $request->reg_number;
        $Vehicle->vehicle_type  = $request->vehicle_type;
        $Vehicle->branch_id     = $request->branch_id;
        $Vehicle->save();
        return redirect('delivery-vehicle')->withSuccess('Vehicle Updated Successfully.');;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\deliveryVehicle  $deliveryVehicle
     * @return \Illuminate\Http\Response
     */
    public function destroy(DeliveryVehicle $DeliveryVehicle,$id)
    {
        DeliveryVehicle::where('id',$id)->update(array('isDeleted'=>1));
        return redirect('delivery-vehicle')->withSuccess('Vehicle Deleted Successfully.');;
    }
}
