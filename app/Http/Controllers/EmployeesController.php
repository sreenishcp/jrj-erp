<?php

namespace App\Http\Controllers;
use App\Models\Branch;
use App\Models\Employees;
use Illuminate\Http\Request;
use App\Http\Requests\StoreEmployeeRequest;
use Storage;
use App\Http\Resources\EmployeeCollection;
class EmployeesController extends Controller
{
    // public function __construct() {
    //     $this->middleware('auth');
    // }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return new EmployeeCollection(Employees::where('isDeleted',0)->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $breadcrumbs = [
            ['link' => "modern", 'name' => "Home"], ['link' => "employees", 'name' => "Employee"], ['name' => "Add Employee"]];

        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true, 'isFabButton' => false
        ];
        $data['pageConfigs'] = $pageConfigs;
        $data['breadcrumbs'] = $breadcrumbs;
        $data['branches']    = Branch::orderBy('id')->pluck('name','id');
        return view('employees.add',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEmployeeRequest $request)
    {
        $employees                = new Employees;
        $employees->name          = $request->name;
        $employees->email         = $request->email;
        $employees->phone         = $request->phone;
        $employees->status        = $request->status;
        $employees->proof_type    = $request->proof_type;
        $employees->designation   = $request->designation;
        $employees->address       = $request->address;
        $employees->branch_id     = $request->branch_id;
        if ($request->hasFile('image')) {
            request()->validate([
                'image' => 'mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            $filenameWithExt = $request->file('image')->getClientOriginalName ();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('image')->getClientOriginalExtension();
            $fileNameToStore = $filename. '_'. time().'.'.$extension;
            $path = $request->file('image')->storeAs('public/images/employees/', $fileNameToStore);
            $employees->image       = $fileNameToStore;
        }
        if ($request->hasFile('proof')) {
            request()->validate([
                'proof' => 'mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            $filenameWithExt = $request->file('proof')->getClientOriginalName ();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('proof')->getClientOriginalExtension();
            $fileNameToStore = $filename. '_'. time().'.'.$extension;
            $path = $request->file('proof')->storeAs('public/images/employees/proof', $fileNameToStore);
            $employees->proof       = $fileNameToStore;
        }
        $employees->save();
        return response()->json('successfully added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employees  $employees
     * @return \Illuminate\Http\Response
     */
    public function show(Employees $employees,$id)
    {
        $data['employee']  = Employees::with('branch')->find($id);
        return view('employees.view', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employees  $employees
     * @return \Illuminate\Http\Response
     */
    public function edit(Employees $employees,$id)
    {
        $employee = Employees::find($id);
        return response()->json($employee);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employees  $employees
     * @return \Illuminate\Http\Response
     */
    public function update(StoreEmployeeRequest $request, Employees $employees,$id)
    {
        $employee                 = new Employees();
        $employee->exists         = true;
        $employee->id             = $request->id; //already exists in database
        $employee->name          = $request->name;
        $employee->email         = $request->email;
        $employee->phone         = $request->phone;
        $employee->status        = $request->status;
        $employee->proof_type    = $request->proof_type;
        $employee->designation   = $request->designation;
        $employee->address       = $request->address;
        $employees->branch_id    = $request->branch_id;
        if ($request->hasFile('new_image')) {
            request()->validate([
                'new_image' => 'mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            $filenameWithExt = $request->file('new_image')->getClientOriginalName ();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('new_image')->getClientOriginalExtension();
            $fileNameToStore = $filename. '_'. time().'.'.$extension;
            $path = $request->file('new_image')->storeAs('public/images/employees/', $fileNameToStore);
            $employee->image       = $fileNameToStore;
            if(Storage::exists('public/images/employees/'.$request->old_image)){
                Storage::delete('public/images/employees/'.$request->old_image);
            }
        }
        if ($request->hasFile('proof_new')) {
            request()->validate([
                'proof_new' => 'mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            $filenameWithExt = $request->file('proof_new')->getClientOriginalName ();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('proof_new')->getClientOriginalExtension();
            $fileNameToStore = $filename. '_'. time().'.'.$extension;
            $path = $request->file('proof_new')->storeAs('public/images/employees/proof/', $fileNameToStore);
            $employee->proof       = $fileNameToStore;
            if(Storage::exists('public/images/employees/proof/'.$request->old_proof)){
                Storage::delete('public/images/employees/proof/'.$request->old_proof);
            }
        }
        $employee->save();
        return response()->json('Updated Sccess');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employees  $employees
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employees $employees,$id)
    {
        Employees::where('id',$id)->update(array('isDeleted'=>1));
        return response()->json('Deleted Sccessfully');
    }
}
