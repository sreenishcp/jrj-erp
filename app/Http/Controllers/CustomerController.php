<?php

namespace App\Http\Controllers;
use App\Models\Branch;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCustomerRequest;
use App\Http\Resources\CustomerCollection;
class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return new CustomerCollection(Customer::where('isDeleted',0)->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $breadcrumbs = [
            ['link' => "modern", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Customer"], ['name' => "Add Customer"]];
        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true, 'isFabButton' => false
        ];
        $data['pageConfigs'] = $pageConfigs;
        $data['breadcrumbs'] = $breadcrumbs;
        $data['branches']    = Branch::orderBy('id')->pluck('name','id');
        return view('customer.add',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCustomerRequest $request)
    {
        $customer                = new Customer;
        $customer->name          = $request->name;
        $customer->last_name     = $request->last_name;
        $customer->email         = $request->email;
        $customer->phone         = $request->phone;
        $customer->status        = $request->status;
        $customer->door_number   = $request->door_number;
        $customer->postcode      = $request->postcode;
        $customer->address_line  = $request->address_line;
        $customer->branch_id     = $request->branch_id;
        $customer->member_status = $request->member_status;
        $customer->password      = bcrypt($request->password);
        if ($request->hasFile('image')) {
            request()->validate([
                'image' => 'mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            $filenameWithExt = $request->file('image')->getClientOriginalName ();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('image')->getClientOriginalExtension();
            $fileNameToStore = $filename. '_'. time().'.'.$extension;
            $path = $request->file('image')->storeAs('public/images/customers/', $fileNameToStore);
            $customer->image       = $fileNameToStore;
        }
        $customer->save();
        return response()->json('Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer,$id)
    {
        $customers = Customer::find($id);
        return response()->json($customers);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(StoreCustomerRequest $request, Customer $customer,$id)
    {
        $customer                = new Customer;
        $customer->exists        = true;
        $customer->id            = $request->id;
        $customer->name          = $request->name;
        $customer->last_name     = $request->last_name;
        $customer->email         = $request->email;
        $customer->phone         = $request->phone;
        $customer->status        = $request->status;
        $customer->door_number   = $request->door_number;
        $customer->postcode      = $request->postcode;
        $customer->address_line  = $request->address_line;
        $customer->branch_id     = $request->branch_id;
        $customer->member_status = $request->member_status;
        if ($request->hasFile('new_image')) {
            request()->validate([
                'new_image' => 'mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            $filenameWithExt = $request->file('new_image')->getClientOriginalName ();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('new_image')->getClientOriginalExtension();
            $fileNameToStore = $filename. '_'. time().'.'.$extension;
            $path = $request->file('new_image')->storeAs('public/images/customers/', $fileNameToStore);
            $customer->image       = $fileNameToStore;
        }
        $customer->save();
        return redirect('customers')->withSuccess('Customer Updated Successfully.');;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer,$id)
    {
        Customer::where('id',$id)->update(array('isDeleted'=>1));
        return response()->json('Deleted Successfully');
        //return redirect('customers')->withSuccess('Customer Deleted Successfully.');;
    }
}
