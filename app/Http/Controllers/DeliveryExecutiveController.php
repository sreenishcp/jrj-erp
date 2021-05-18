<?php

namespace App\Http\Controllers;
use App\Models\DeliveryExecutive;
use App\Models\Branch;
use App\Models\Employees;
use App\Models\DeliveryVehicle;
use Illuminate\Http\Request;
use App\Http\Requests\StoreDeliveryDetailsRequest;

class DeliveryExecutiveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $breadcrumbs = [
            ['link' => "modern", 'name' => "Home"], ['link' => "products", 'name' => "Delivery Executives"], ['name' => "Delivery List"]];
        $pageConfigs = ['pageHeader' => true, 'isFabButton' => false];

        $QUERY      = DeliveryExecutive::query();
        $search_status  =  0;
        if($request->get('method')!=''){
            $QUERY=$QUERY->where('method',$request->get('method'));
            $search_status  =  1;
        }
        if($request->get('delivery_date')!=''){
         $delivery_date   =   date("Y-m-d",strtotime(str_replace('/', '-',$request->get('delivery_date'))));
         $QUERY=$QUERY->where('delivery_date',$delivery_date);
         $search_status  =  1;
        }
        $data['search_status']  = $search_status;
        $data['details']        = $QUERY->where('isDeleted',0)->orderBy('id','desc')->get();
        $data['method']         = $request->get('method');
        $data['delivery_date']  = $request->get('delivery_date');
        $data['pageConfigs']    = $breadcrumbs;
        $data['breadcrumbs']    = $pageConfigs;
        return view('delivery_executives.list',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $breadcrumbs = [
            ['link' => "modern", 'name' => "Home"], ['link' => "
            ", 'name' => "Delivery Executive"], ['name' => "Add Delivery"]];

        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true, 'isFabButton' => false
        ];
        $data['pageConfigs'] = $pageConfigs;
        $data['breadcrumbs'] = $breadcrumbs;
        $data['branches']    = Branch::orderBy('id')->pluck('name','id');
        $data['delivery_person']  = Employees::where('isDeleted',0)->where('designation','delivery_executive')->orderBy('name')->pluck('name','id');
        $data['delivery_vehicle']   = DeliveryVehicle::where('isDeleted',0)->get()->pluck('full_name', 'id');
        //print_r($data['categories']);exit();
        return view('delivery_executives.add',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDeliveryDetailsRequest $request)
    {
        $executives                = new DeliveryExecutive;
        $executives->method        = $request->method;
        $executives->delivery_date = date("Y-m-d",strtotime(str_replace('/', '-',$request->delivery_date)));
        if($request->method=='others')
        $executives->others                = $request->others;
        $executives->distance              = $request->distance;
        $executives->delivery_time         = date("H:i", strtotime($request->delivery_time));
        $executives->delivery_person       = $request->delivery_person;
        $executives->delivery_vehicle_type = $request->delivery_vehicle_type;
        if($request->delivery_vehicle_type=='company')
        $executives->delivery_vehicle_id   = $request->delivery_vehicle_id;
        $executives->branch_id             = $request->branch_id;
        $executives->delivery_note         = $request->delivery_note;
        $executives->save();
        return redirect('executives')->withSuccess('Delivery Details Added Successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DeliveryExecutive  $deliveryExecutive
     * @return \Illuminate\Http\Response
     */
    public function show(DeliveryExecutive $deliveryExecutive,$id)
    {
        $data['details'] = DeliveryExecutive::with('employ','vehicle','branch')->find($id);
        return view('delivery_executives.view', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DeliveryExecutive  $deliveryExecutive
     * @return \Illuminate\Http\Response
     */
    public function edit(DeliveryExecutive $deliveryExecutive,$id)
    {
        $breadcrumbs = [
            ['link' => "modern", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Delivery"], ['name' => "Delivery"]];
        $pageConfigs = ['pageHeader' => true, 'isFabButton' => false];
        $data['pageConfigs']      = $pageConfigs;
        $data['breadcrumbs']      = $breadcrumbs;
        $data['detail']           = DeliveryExecutive::find($id);
        $data['branches']         = Branch::orderBy('id')->pluck('name','id');
        $data['delivery_person']  = Employees::where('designation','delivery_executive')->orderBy('name')->pluck('name','id');
        $data['delivery_vehicle'] = DeliveryVehicle::get()->pluck('full_name', 'id');
        return view('delivery_executives.add', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DeliveryExecutive  $deliveryExecutive
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DeliveryExecutive $deliveryExecutive,$id)
    {
        $executives                = new DeliveryExecutive;
        $executives->exists        = true;
        $executives->id            = $request->id;
        $executives->method        = $request->method;
        $executives->delivery_date = date("Y-m-d",strtotime(str_replace('/', '-',$request->delivery_date)));
        if($request->method=='others')
        $executives->others                = $request->others;
        $executives->distance              = $request->distance;
        $executives->delivery_time         = date("H:i", strtotime($request->delivery_time));
        $executives->delivery_person       = $request->delivery_person;
        $executives->delivery_vehicle_type = $request->delivery_vehicle_type;
        if($request->delivery_vehicle_type=='company')
        $executives->delivery_vehicle_id   = $request->delivery_vehicle_id;
        $executives->branch_id             = $request->branch_id;
        $executives->delivery_note         = $request->delivery_note;
        $executives->save();
        return redirect('executives')->withSuccess('Delivery Details Updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DeliveryExecutive  $deliveryExecutive
     * @return \Illuminate\Http\Response
     */
    public function destroy(DeliveryExecutive $deliveryExecutive,$id)
    {
        DeliveryExecutive::where('id',$id)->update(array('isDeleted'=>1));
        return redirect('executives')->withSuccess('Delivery Details Deleted Successfully.');
    }
}
