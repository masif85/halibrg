<?php
namespace App\Http\Controllers;
use App\Models\Categories;
use Illuminate\Http\Request;
use Auth;
class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {      
        $categories =  Categories::all();		 
        return view('categories.list', compact('categories','categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {	
		
        return view('categories.create');
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
            'txtname'=>'required'        
        ]);
        $categories = new Categories([
            'name' => $request->get('txtname')         
        ]);
        $categories->save();
        return redirect('/categories')->with('success', 'Category has been added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function show(Categories $categories,$id)
    {
        $categories = Categories::find($id);			  
        return view('categories.view',compact('categories'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function edit(Categories $categories,$id)
    {        
		$categories = Categories::find($id);
         return view('categories.edit',compact('categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Categories $categories,$id)
    {
        $request->validate([
            'txtname'=>'required'
        ]);

        $categories = Categories::find($id);       
		$categories->name = $request->get('txtname'); 
        $categories->update(); 
        return redirect('/categories')->with('success', 'Category updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function destroy(Categories $categories,$id)
    {
        $categories = Categories::find($id);
        $categories->delete();
        return redirect('/categories')->with('success', 'Category deleted successfully');
    }
}
