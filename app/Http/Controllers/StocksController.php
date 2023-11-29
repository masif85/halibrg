<?php
namespace App\Http\Controllers;
use App\Models\Stocks;
use App\Models\Users;
use App\Models\Products;
use App\Models\Categories;
use Illuminate\Http\Request;
class StocksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {      
       
		$stocks= Stocks::leftJoin('tbl_products', 'tbl_products.id', '=', 'tbl_stocks.product_id')              		
              		->get(['tbl_products.name as product_name', 'tbl_stocks.*']);		 
        return view('stocks.list', compact('stocks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {	
		$users =  Users::all();
		 $products =  Products::all();
		$categories =  Categories::all();
        return view('stocks.create', compact('products'));
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
            'txtproduct'=>'required',
            'txtname'=> 'required',
            'txtquantity' => 'required'
        ]);
        $stocks = new Stocks([
            'product_id' => $request->get('txtproduct'),
            'supplier_name'=> $request->get('txtname'),
            'quantity'=> $request->get('txtquantity')			
        ]);
        $stocks->save();
        return redirect('/stocks')->with('success', 'Stock Quantity has been updated');
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Stocks  $stocks
     * @return \Illuminate\Http\Response
     */
    public function show(Stocks $stocks,$id)
    {
          //$stocks = Stocks::find($id);
		 
		  	$stocks= Stocks::leftjoin('tbl_categories', 'tbl_categories.id', '=', 'tbl_stocks.category')
              		->leftjoin('tbl_users', 'tbl_users.id', '=', 'tbl_stocks.user_id')
              		->get(['tbl_categories.name as cat_name', 'tbl_users.name as user_name', 'tbl_stocks.*'])->where('id', $id)->first();
					
		 
		  
        return view('stocks.view',compact('stocks'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Stocks  $stocks
     * @return \Illuminate\Http\Response
     */
    public function edit(Stocks $stocks,$id)
    {
         $stocks = Stocks::leftjoin('tbl_categories', 'tbl_categories.id', '=', 'tbl_stocks.category')
              		->leftjoin('tbl_users', 'tbl_users.id', '=', 'tbl_stocks.user_id')
              		->get(['tbl_categories.name as cat_name', 'tbl_categories.id as cat_id','tbl_users.name as user_name','tbl_users.id as u_id', 'tbl_stocks.*'])->where('id', $id)->first();
		 $users =  Users::all();
		$categories =  Categories::all();
         return view('stocks.edit',compact('stocks','users','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Stocks  $stocks
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Stocks $stocks,$id)
    {
              $request->validate([
            'txtusers'=>'required',
            'txtcat'=> 'required',
            'txtname' => 'required',
			'txtcode' => 'required',
			'txtcost' => 'required',
			'txtdesc' => 'required'
            
        ]);

        $stocks = Stocks::find($id);
        if($request->hasfile('image'))
        {     
       
            $file = $request->file('image');           
            $extenstion = $file->getClientOriginalExtension();
            $filename = time().'.'.$extenstion;
            $file->move('uploads/stocks/', $filename);
			$stocks->image = $filename;
           
        } 


        $stocks->user_id = $request->get('txtusers');
        $stocks->category = $request->get('txtcat');
        $stocks->cost = $request->get('txtcost');
		$stocks->name = $request->get('txtname');
		$stocks->code = $request->get('txtcode');
		$stocks->description = $request->get('txtdesc');
         		 

       // $users->image = $request->get('txtimage'); 
        $stocks->update(); 
        return redirect('/stocks')->with('success', 'Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Stocks  $stocks
     * @return \Illuminate\Http\Response
     */
    public function destroy(Stocks $stocks,$id)
    {
        $stocks = Stocks::find($id);
        $stocks->delete();
        return redirect('/stocks')->with('success', 'Product deleted successfully');
    }
}
