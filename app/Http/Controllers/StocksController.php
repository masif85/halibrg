<?php
namespace App\Http\Controllers;
use App\Models\Stocks;
use App\Models\Users;
use App\Models\Products;
use App\Models\Categories;
use Illuminate\Http\Request;
use Auth;
class StocksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 
		$stocks= Stocks::leftJoin('tbl_products', 'tbl_products.id', '=', 'tbl_stocks.product_id')->groupBy('product_id')->get(['tbl_products.name as product_name', 'tbl_stocks.*',Stocks::raw('sum(tbl_stocks.quantity) as quantity')]);        
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
		$total= count($request->get('txtname'));
		for($i=0;$i<$total;$i++):
        $stocks = new Stocks([
            'product_id' => $request->get('txtproduct'),
            'supplier_name'=> $request->get('txtname')[$i],
            'quantity'=> $request->get('txtquantity')[$i],
			'date'=>$request->get('txtdate')[$i]
        ]);
        $stocks->save();       
		endfor;
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
		/* $stocks= Stocks::leftJoin('tbl_products', 'tbl_products.id', '=', 'tbl_stocks.product_id')              		
              		->get(['tbl_products.name as product_name', 'tbl_stocks.*'])->where('id', $id)->first(); */
					$product_data=Products::where('id', '=', $id)->first();
			$stocks=Stocks::leftJoin('tbl_products', 'tbl_products.id', '=', 'tbl_stocks.product_id')              		
              		->get(['tbl_products.name as product_name','tbl_products.id as product_id', 'tbl_stocks.*'])->where('product_id', $id);			  
        return view('stocks.view',compact('stocks','id','product_data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Stocks  $stocks
     * @return \Illuminate\Http\Response
     */
    public function edit(Stocks $stocks,$id)
    {
        $product_data=Products::where('id', '=', $id)->first();
         $stocks = Stocks::leftJoin('tbl_products', 'tbl_products.id', '=', 'tbl_stocks.product_id')              		
              		->get(['tbl_products.name as product_name','tbl_products.id as product_id', 'tbl_stocks.*'])->where('product_id', $id);       
		$products =  Products::all();					
         return view('stocks.edit',compact('stocks','products','id','product_data'));
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
            //'txtproduct'=>'required',
            //'txtname'=> 'required',
            //'txtquantity' => 'required'
        ]);
		
	$total= count($request->get('txtname'));	
	if($total>0):		
        Stocks::where('product_id', $id)->delete();
	for($i=0;$i<$total;$i++):
        $stocks = new Stocks([
            'product_id' => $id,
            'supplier_name'=> $request->get('txtname')[$i],
            'quantity'=> $request->get('txtquantity')[$i],
			'date'=> $request->get('txtdate')[$i]			
        ]);
        $stocks->save();       
    endfor;
	endif;
     return redirect('/stocks')->with('success', 'Stock updated successfully');         
/*

        $stocks = Stocks::find($id);          
		$stocks->product_id = $request->get('txtproduct');
        $stocks->update(); 
        return redirect('/stocks')->with('success', 'Stock updated successfully');
        */
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
