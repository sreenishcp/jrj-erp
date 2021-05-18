<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Branch;
use App\Models\Unit;
use App\Models\Category;
use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequst;

class ProductController extends Controller
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
            ['link' => "modern", 'name' => "Home"], ['link' => "products", 'name' => "Products"], ['name' => "Product List"]];
        $pageConfigs = ['pageHeader' => true, 'isFabButton' => false];

        $QUERY      = Product::with('supplier','category','unit');
        $search_status  =  0;
        if($request->get('status')!=''){
            $QUERY=$QUERY->where('status',$request->get('status'));
            $search_status  =  1;
        }
        if($request->get('category_id')!=''){
            $QUERY=$QUERY->where('category_id',$request->get('category_id'));
            $search_status  =  1;
        }
        if($request->get('search_key')){
            $search_status  =  1;
            $search_key=$request->get('search_key');
            $QUERY=$QUERY->where('name', 'LIKE', "%$search_key%");
        }
        $data['search_status']  = $search_status;
        $data['products']       = $QUERY->where('isDeleted',0)->orderBy('id','desc')->get();
        $data['categories']     = Category::with('children')->where('isDeleted',0)->get()->toArray();
        $data['status']         = $request->get('status');
        $data['search_key']     = $request->get('search_key');
        $data['category_id']    = $request->get('category_id');
        $data['pageConfigs']    = $breadcrumbs;
        $data['breadcrumbs']    = $pageConfigs;
        return view('product.list',$data);
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
            ", 'name' => "Product"], ['name' => "Add Product"]];

        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true, 'isFabButton' => false
        ];
        $data['pageConfigs'] = $pageConfigs;
        $data['breadcrumbs'] = $breadcrumbs;
        $data['branches']    = Branch::orderBy('id')->pluck('name','id');
        $data['units']       = Unit::orderBy('id')->pluck('name','id');
        $data['suppliers']   = Supplier::orderBy('id')->pluck('name','id');
        $data['categories']  = Category::with('children')->where('isDeleted',0)->get()->toArray();
        //print_r($data['categories']);exit();
        return view('product.add',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequst $request)
    {
        $product                 = new Product;
        $product->name           = $request->name;
        $product->cost           = $request->cost;
        $product->selling_price  = $request->selling_price;
        $product->supplier_id    = 0;
        $product->category_id    = $request->category_id;
        $product->unit_id        = $request->unit_id;
        $product->quandity       = $request->quandity;
        $product->branch_id      = $request->branch_id;
        $product->note           = $request->note;
        if ($request->hasFile('images')) {
            $names = [];
            foreach($request->file('images') as $image)
            {
                $filenameWithExt = $image->getClientOriginalName ();
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $extension = $image->getClientOriginalExtension();
                $fileNameToStore = $filename. '_'. time().'.'.$extension;
                $path = $image->storeAs('public/images/product/', $fileNameToStore);
                array_push($names, $fileNameToStore);          
            }
        }
        $images           = implode(',',$names);
        $product->images  = $images;
        $product->save();
        return redirect('products')->withSuccess('Product Added Successfully.');;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product,$id)
    {
        $data['product']  = Product::with('supplier','category','unit','branch')->find($id);
        return view('product.view', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product,$id)
    {
        $breadcrumbs = [
            ['link' => "modern", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Product"], ['name' => "Product List"]];
        $pageConfigs = ['pageHeader' => true, 'isFabButton' => false];
        $data['pageConfigs'] = $pageConfigs;
        $data['breadcrumbs'] = $breadcrumbs;
        $data['product']     = Product::find($id);
        $data['branches']    = Branch::orderBy('id')->pluck('name','id');
        $data['units']       = Unit::orderBy('id')->pluck('name','id');
        $data['suppliers']   = Supplier::orderBy('id')->pluck('name','id');
        $data['categories']  = Category::with('children')->where('isDeleted',0)->get()->toArray();
        return view('product.add', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequst $request, Product $product,$id)
    {
        $product_details         = Product::find($id);
        $product                 = new Product;
        $product->exists         = true;
        $product->id             = $request->id; //already exists in database
        $product->name           = $request->name;
        $product->cost           = $request->cost;
        $product->selling_price  = $request->selling_price;
        $product->supplier_id    = 0;
        $product->category_id    = $request->category_id;
        $product->unit_id        = $request->unit_id;
        $product->quandity       = $request->quandity;
        $product->branch_id      = $request->branch_id;
        $product->note           = $request->note;
        if ($request->hasFile('images')) {
            $names = [];
            foreach($request->file('images') as $image)
            {
                request()->validate([
                    'images' => 'required|max:2048',
                ]);
                $filenameWithExt = $image->getClientOriginalName ();
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $extension = $image->getClientOriginalExtension();
                $fileNameToStore = $filename. '_'. time().'.'.$extension;
                $path = $image->storeAs('public/images/product/', $fileNameToStore);
                array_push($names, $fileNameToStore);          
            }
            $existing_img     = explode(",",$product_details->images);
            $all_images       = array_merge($names, $existing_img);
            $new_images       = implode(',',$all_images);
            $product->images  = rtrim($new_images, ',');
        }
        else{
            if($product_details->images=='')
                request()->validate([
                    'images' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                ]);
        }
        $product->save();
        return redirect('products')->withSuccess('Product Updated Successfully.');;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product,$id)
    {
        Product::where('id',$id)->update(array('isDeleted'=>1));
        return redirect('products')->withSuccess('Product Deleted Successfully.');;
    }
    public function delete_product_image(Request $request)
    {
        $product = Product::find($request->id);
        $images  = $product->images;
        $img_ar  = explode(",",$images);

        $i = array_search($request->image,$img_ar);
        unset($img_ar[$i]);
        $images = '';
        if(!empty($img_ar)){
           echo $images = implode(",",$img_ar);
        }
        Product::where('id',$request->id)->update(array('images'=>$images));
    }
}
