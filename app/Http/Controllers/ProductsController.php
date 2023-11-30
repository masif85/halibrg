<?php
namespace App\Http\Controllers;
use App\Models\Products;
use App\Models\Users;
use App\Models\Categories;
use App\Models\Stocks;
use Illuminate\Http\Request;
use Auth;
Use Exception;
class ProductsController extends Controller
{
  

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      
        //$products =  Products::all();
		$products= Products::leftJoin('tbl_categories', 'tbl_categories.id', '=', 'tbl_products.category')
              		->leftJoin('tbl_users', 'tbl_users.id', '=', 'tbl_products.user_id')
                    ->leftJoin('tbl_users_favorites', 'tbl_users_favorites.product_id', '=', 'tbl_products.id')
                    ->leftJoin('tbl_stocks', 'tbl_stocks.product_id', '=', 'tbl_products.id')->groupBy('tbl_products.id')
              		->get(['tbl_categories.name as cat_name', 'tbl_users.name as user_name', 'tbl_products.*',Stocks::raw('sum(tbl_stocks.quantity) as quantity'),'tbl_users_favorites.user_id as fav_user_id']);

        return view('products.list', compact('products','products'));
    }


      public function view()
    {
      
        //$products =  Products::all();
        $products= Products::leftJoin('tbl_categories', 'tbl_categories.id', '=', 'tbl_products.category')
                    ->leftJoin('tbl_users', 'tbl_users.id', '=', 'tbl_products.user_id')
                    ->leftJoin('tbl_users_favorites', 'tbl_users_favorites.product_id', '=', 'tbl_products.id')
                    ->leftJoin('tbl_stocks', 'tbl_stocks.product_id', '=', 'tbl_products.id')->groupBy('tbl_products.id')
                    ->get(['tbl_categories.name as cat_name', 'tbl_users.name as user_name', 'tbl_products.*',Stocks::raw('sum(tbl_stocks.quantity) as quantity'),'tbl_users_favorites.user_id as fav_user_id']);

        return view('products.view_product', compact('products','products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		
		$products =  Products::all();
		$users =  Users::all();
		$categories =  Categories::all();
        return view('products.create', compact('products','users','categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {            
        $request->validate([
            'txtusers'=>'required',
            'txtcat'=> 'required',
            'txtname' => 'required',
			'txtcode' => 'required',
			'txtcode' => 'unique:tbl_products,code',
			'txtcost' => 'required',
			'txtdesc' => 'required',
            'image' => 'required'
        ]);

$filename ="";
         if($request->hasfile('image'))
        {                       
            $file = $request->file('image');           
            $extenstion = $file->getClientOriginalExtension();
            $filename = time().'.'.$extenstion;
            $file->move('uploads/products/', $filename);
            //$users->image = $filename;
        } 
        $products = new Products([
            'user_id' => Auth::user()->id,
            'category'=> $request->get('txtcat'),
            'cost'=> $request->get('txtcost'),
			 'name' => $request->get('txtname'),
            'code'=> $request->get('txtcode'),
            'description'=> $request->get('txtdesc'),
            'image'=>$filename
        ]);
try
{
$products->save();
}
    catch(\Throwable $e)
{
  //return "Error";
  return redirect('/products/create')->with('success', "Error Occurred");
}    
        return redirect('/product')->with('success', 'Product has been added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function show(Products $products,$id)
    {
          //$products = Products::find($id);
		 
		  	$products= Products::leftjoin('tbl_categories', 'tbl_categories.id', '=', 'tbl_products.category')
              		->leftjoin('tbl_users', 'tbl_users.id', '=', 'tbl_products.user_id')
              		->get(['tbl_categories.name as cat_name', 'tbl_users.name as user_name', 'tbl_products.*'])->where('id', $id)->first();
					
		 
		  
        return view('products.view',compact('products'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function edit(Products $products,$id)
    {
         $products = Products::leftjoin('tbl_categories', 'tbl_categories.id', '=', 'tbl_products.category')
              		->leftjoin('tbl_users', 'tbl_users.id', '=', 'tbl_products.user_id')
              		->get(['tbl_categories.name as cat_name', 'tbl_categories.id as cat_id','tbl_users.name as user_name','tbl_users.id as u_id', 'tbl_products.*'])->where('id', $id)->first();
		 $users =  Users::all();
		$categories =  Categories::all();
         return view('products.edit',compact('products','users','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Products $products,$id)
    {
              $request->validate([
            'txtusers'=>'required',
            'txtcat'=> 'required',
            'txtname' => 'required',
			'txtcode' => 'required',
			'txtcost' => 'required',
			'txtdesc' => 'required'
            
        ]);

        $products = Products::find($id);
        if($request->hasfile('image'))
        {     
       
            $file = $request->file('image');           
            $extenstion = $file->getClientOriginalExtension();
            $filename = time().'.'.$extenstion;
            $file->move('uploads/products/', $filename);
			$products->image = $filename;
           
        } 


        $products->user_id = Auth::user()->id;
        $products->category = $request->get('txtcat');
        $products->cost = $request->get('txtcost');
		$products->name = $request->get('txtname');
		$products->code = $request->get('txtcode');
		$products->description = $request->get('txtdesc');
         		 

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
    public function destroy(Products $products,$id)
    {
        $products = Products::find($id);
        $products->delete();
        return redirect('/products')->with('success', 'Product deleted successfully');
    }
}
