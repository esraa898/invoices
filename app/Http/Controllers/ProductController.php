<?php

namespace App\Http\Controllers;

use App\Http\Requests\Products\AddProductRequest;
use App\Http\Requests\Products\UpdateProductRequest;
use App\Models\product;
use App\Models\section;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products= product::with('section')->get();
        return view('products.products',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sections=  section::all();
        return view('products.addproduct',compact('sections'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddProductRequest $request)
    {
        product::create([
            'product_name'=>$request->product_name,
            'description'=>$request->description,
            'section_id'=>$request->section_id,

        ]);
        session()->flash('done','تم اضافه القسم بنجاح ');
           return redirect('/products ');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product= product::find($id);
        $sections= section::all();
        return view('products.editproduct',compact('product','sections'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request,$id)
    {
            $product = product::find($id);
            $product->update([
                'product_name'=>$request->product_name,
            'description'=>$request->description,
            'section_id'=>$request->section_id,
            ]);
            session()->flash('done','تم تعديل  القسم بنجاح ');
            return redirect('/products ');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
           product::find($id)->delete();
      
        session()->flash('done','تم حذف  القسم بنجاح ');
        return redirect('/products ');

    }
}
