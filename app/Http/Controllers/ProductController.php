<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        return view('products')->with('products',$products);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product = new Product;
        $product->name=$request->product_name;
        $product->description=$request->product_description;
        $product->price=$request->product_price;
        $product->status=$request->product_status;
        $file = $request->file('img');
        if($file==''){
            $product->image = 'bg.jpg';
        }
        else{
            $product->image=$request->file('img')->getClientOriginalName();
            $destinationPath = public_path().'/images';
            $file->move($destinationPath,$product->image);
        }
        $product->save();
        toastr()->success('Product added Successfully');
        return redirect('products');
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $file = $request->file('img');
        if($file==''){
            $img = Product::find($id)->value('image');
            $pic=$img;
        }
        else{
            $pic=$request->file('img')->getClientOriginalName();
            $destinationPath = public_path().'/images' ;
            $file->move($destinationPath,$pic);
        }
        $data = Product::where('id',$id)->update(['name'=>$request->product_name,'description'=>$request->product_description, 'price' => $request->product_price,'status'=>$request->product_status,'image'=>$pic]);
        toastr()->success('Product Updated Successfully');
        return redirect('products');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();
        toastr()->success('Product Deleted Successfully');
        return redirect('products');
    }
}
