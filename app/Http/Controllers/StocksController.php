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
		  
		 $stocks= Stocks::leftJoin('tbl_products', 'tbl_products.id', '=', 'tbl_stocks.product_id')              		
              		->get(['tbl_products.name as product_name', 'tbl_stocks.*'])->where('id', $id)->first();	 
		  
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
         $stocks = Stocks::leftJoin('tbl_products', 'tbl_products.id', '=', 'tbl_stocks.product_id')              		
              		->get(['tbl_products.name as product_name','tbl_products.id as product_id', 'tbl_stocks.*'])->where('id', $id)->first();
		$products =  Products::all();					
         return view('stocks.edit',compact('stocks','products'));
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
            'txtproduct'=>'required'
            
        ]);
        $stocks = Stocks::find($id);          
		$stocks->product_id = $request->get('txtproduct');
        $stocks->update(); 
        return redirect('/stocks')->with('success', 'Stock updated successfully');
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
