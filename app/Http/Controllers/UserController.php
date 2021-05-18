<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Branch;
use Illuminate\Http\Request;
use App\Http\Requests\StoreUserRequest;
use App\Http\Resources\UserCollection;
class UserController extends Controller
{
    // public function __construct() {
    //     $this->middleware('auth');
    // }
    public function create()
    {
        $data['breadcrumbs'] = [
            ['link' => "modern", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "User"], ['name' => "Add Users"]];
        //Pageheader set true for breadcrumbs
        $data['pageConfigs'] = ['pageHeader' => true, 'isFabButton' => false];
        $data['branches']    =   Branch::orderBy('id')->pluck('name','id');
        return view('user.add-users', $data);
    }
    public function store(StoreUserRequest $request)
    {
        $user = new User;
        $user->firstname = $request->firstname;
        $user->lastname  = $request->lastname;
        $user->email     = $request->email;
        $user->phone     = $request->phone;
        $user->role      = $request->role;
        $user->password  = bcrypt($request->password);
        $user->status    = $request->status;
        $user->branch_id = $request->branch_id;
        if ($request->hasFile('image')) {
            request()->validate([
                'image' => 'mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            $filenameWithExt = $request->file('image')->getClientOriginalName ();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('image')->getClientOriginalExtension();
            $fileNameToStore = $filename. '_'. time().'.'.$extension;
            $path = $request->file('image')->storeAs('public/images/users/', $fileNameToStore);
            $user->image       = $fileNameToStore;
        }
        $user->save();
        return response()->json('successfully added');
    }
    public function index(Request $request)
    {
        return new UserCollection(User::where('isDeleted',0)->where('role','!=','admin')->get());
    }
    public function edit($id)
    {
        $user = User::find($id);
        return response()->json($user);
    }
    public function update(StoreUserRequest $request,$id)
    {
        $user = new User();
        $user->exists = true;
        $user->id = $request->id; //already exists in database.
        $user->firstname = $request->firstname;
        $user->lastname  = $request->lastname;
        $user->email     = $request->email;
        $user->phone     = $request->phone;
        $user->role      = $request->role;
        $user->branch_id = $request->branch_id;
        if($request->password!=''){
            $validatedData = $request->validate([
                'password'  => 'required|confirmed|min:6',
              ]);
            $user->password  = bcrypt($request->password);
        }
        if ($request->hasFile('new_image')) {
            request()->validate([
                'new_image' => 'mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            $filenameWithExt = $request->file('new_image')->getClientOriginalName ();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('new_image')->getClientOriginalExtension();
            $fileNameToStore = $filename. '_'. time().'.'.$extension;
            $path = $request->file('new_image')->storeAs('public/images/users/', $fileNameToStore);
            $user->image       = $fileNameToStore;
        }
        $user->status      = $request->status;
        $user->save();
        return response()->json('success');
    }
    public function show(Request $request,$id)
    {
        $data['user']  = User::with('branch')->find($id);
        return view('user.user-view', $data);
    }
    public function destroy(User $user,$id)
    {
        User::where('id',$id)->update(array('isDeleted'=>1));
        return response()->json('successfully deleted');
        // return redirect('user')->withSuccess('User Deleted Successfully.');
    }

}
