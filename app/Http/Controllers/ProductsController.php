<?php

namespace App\Http\Controllers;
use App\Models\Products;
use Illuminate\Http\Request;


class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      
        $products =  Products::all();
        return view('products.list', compact('products','products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
             //
        $request->validate([
            'txtname'=>'required',
            'txtemail'=> 'required',
            'txtpassword' => 'required',
            'image' => 'required'
        ]);


         if($request->hasfile('image'))
        {                       
            $file = $request->file('image');           
            $extenstion = $file->getClientOriginalExtension();
            $filename = time().'.'.$extenstion;
            $file->move('uploads/products/', $filename);
            //$users->image = $filename;
        } 
        $products = new Users([
            'name' => $request->get('txtname'),
            'email'=> $request->get('txtemail'),
            'password'=> $request->get('txtpassword'),
            'image'=>$filename
        ]);

        $products->save();
        return redirect('/products')->with('success', 'Product has been added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function show(Products $products)
    {
          $products = Products::find($id);
        return view('products.view',compact('products'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function edit(Products $products)
    {
         $products = Products::find($id);
         return view('products.edit',compact('products'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Products $products)
    {
                $request->validate([
            'txtname'=>'required',
            'txtemail'=> 'required',
            'txtpassword' => 'required'
            //,'txtimage' => 'required'
        ]); 

        if($request->hasfile('image'))
        {     
       
            $file = $request->file('image');           
            $extenstion = $file->getClientOriginalExtension();
            $filename = time().'.'.$extenstion;
            $file->move('uploads/products/', $filename);
           
        } 



        $products = Products::find($id);
        $users->name = $request->get('txtname');
        $users->email = $request->get('txtemail');
        $users->password = $request->get('txtpassword');
         $users->image = $filename;

       // $users->image = $request->get('txtimage'); 
        $products->update(); 
        return redirect('/products')->with('success', 'Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function destroy(Products $products)
    {
        $products = Products::find($id);
        $products->delete();
        return redirect('/products')->with('success', 'Product deleted successfully');
    }
}
