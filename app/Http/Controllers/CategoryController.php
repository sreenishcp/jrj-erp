<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCategoryRequest;
use Illuminate\Support\Facades\DB;
use Storage;
class CategoryController extends Controller
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
            ['link' => "modern", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "User"], ['name' => "Category List"]];
        $pageConfigs = ['pageHeader' => true, 'isFabButton' => false];
        $QUERY = DB::table("categories as ca")->select("ca.name", "ca.status", "ca.description", "ca.image", "ca.id", "ca.parent_category","cat.name as parent_category_name")
        ->leftjoin("categories as cat", "ca.parent_category", "=", "cat.id");
        $search_status = 0;
        if($request->get('status')!=''){
            $search_status = 1;
            $QUERY=$QUERY->where('ca.status',$request->get('status'));
        }
        if($request->get('search_key')){
            $search_status = 1;
            $search_key=$request->get('search_key');
            $QUERY=$QUERY->where('ca.name', 'LIKE', "%$search_key%");
        }
        $data['search_status'] = $search_status;
        $data['categories']  = $QUERY->where('ca.isDeleted',0)->orderBy('id','desc')->get();
        $data['status']      = $request->get('status');
        $data['search_key']  = $request->get('search_key');
        $data['pageConfigs'] = $pageConfigs;
        $data['breadcrumbs'] = $breadcrumbs;
        return view('category.list', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $breadcrumbs = [
            ['link' => "modern", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Category"], ['name' => "Add Category"]];
        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true, 'isFabButton' => false
        ];
        $data['categories'] = Category::where('parent_category',0)->where('isDeleted',0)->pluck('name','id')->prepend('Select',0);
        $data['pageConfigs'] = $pageConfigs;
        $data['breadcrumbs'] = $breadcrumbs;
        return view('category.add',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategoryRequest $request)
    {
        $category                  = new Category;
        $category->name            = $request->name;
        $category->description     = $request->description;
        $category->status          = $request->status;
        $category->parent_category = $request->parent_category;
        
        if ($request->hasFile('image')) {
            request()->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            $filenameWithExt = $request->file('image')->getClientOriginalName ();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('image')->getClientOriginalExtension();
            $fileNameToStore = $filename. '_'. time().'.'.$extension;
            $path = $request->file('image')->storeAs('public/images/category', $fileNameToStore);
            $category->image       = $fileNameToStore;
        }
        $category->save();
        $breadcrumbs = [
            ['link' => "modern", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "User"], ['name' => "Add Users"]];
        $pageConfigs = ['pageHeader' => true, 'isFabButton' => false];
        return redirect('category')->withSuccess( 'Category Added Successfully' );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category,$id)
    {
        $breadcrumbs = [
            ['link' => "modern", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "User"], ['name' => "Category List"]];
        $pageConfigs = ['pageHeader' => true, 'isFabButton' => true];
        $data['categories'] = Category::where('id','!=',$id)->where('isDeleted',0)->where('parent_category',0)->pluck('name','id')->prepend('Select',0);
        $data['pageConfigs'] = $pageConfigs;
        $data['breadcrumbs'] = $breadcrumbs;
        $data['category']    = Category::find($id);
        return view('category.add', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(StoreCategoryRequest $request, Category $category,$id)
    {
        $category                   = new Category();
        $category->exists           = true;
        $category->id               = $request->id; //already exists in database.
        $category->name             = $request->name;
        $category->description      = $request->description;
        $category->parent_category  = $request->parent_category;
        if ($request->hasFile('image')) {
            request()->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            $filenameWithExt = $request->file('image')->getClientOriginalName ();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('image')->getClientOriginalExtension();
            $fileNameToStore = $filename. '_'. time().'.'.$extension;
            $path = $request->file('image')->storeAs('public/images/category/', $fileNameToStore);
            $category->image       = $fileNameToStore;
            if(Storage::exists('public/images/category/'.$request->old_img)){
                Storage::delete('public/images/category/'.$request->old_img);
            }
        }
        $category->save();
        return redirect('category')->withSuccess( 'Category Updated Successfully' );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category,$id)
    {
        Category::where('id',$id)->update(array('isDeleted'=>1));
        return redirect('category')->withSuccess('Category Deleted Successfully.');;
    }
    public function delete_category_image(Request $request)
    {
        Category::where('id',$request->id)->update(array('image'=>''));
    }
}

