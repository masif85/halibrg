<?php

namespace App\Http\Controllers;

use App\Models\Users;
use App\Models\Favourites;
use Illuminate\Http\Request;
use Auth;
class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $users =  Users::all();
        return view('users.list', compact('users','users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {       
        return view('users.create');
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
$filename="";

         if($request->hasfile('image'))
        {                       
            $file = $request->file('image');           
            $extenstion = $file->getClientOriginalExtension();
            $filename = time().'.'.$extenstion;
            $file->move('uploads/users/', $filename);
            //$users->image = $filename;
        } 
        $users = new Users([
            'name' => $request->get('txtname'),
            'email'=> $request->get('txtemail'),
            'password'=> bcrypt($request->get('txtpassword')),
            'image'=>$filename
        ]);

        $users->save();
        return redirect('/users')->with('success', 'User has been added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Users  $users
     * @return \Illuminate\Http\Response
     */
    public function show(Users $users,$id)
    {
         $users = Users::find($id);
        return view('users.view',compact('users'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Users  $users
     * @return \Illuminate\Http\Response
     */
    public function edit(Users $users,$id)
    {
         $users = Users::find($id);
         return view('users.edit',compact('users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Users  $users
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Users $users,$id)
    {       
        $request->validate([
            'txtname'=>'required',
            'txtemail'=> 'required',
           // 'txtpassword' => 'required'
            //,'txtimage' => 'required'
        ]); 

$users = Users::find($id);
        if($request->hasfile('image'))
        {            
            $file = $request->file('image');           
            $extenstion = $file->getClientOriginalExtension();
            $filename = time().'.'.$extenstion;
            $file->move('uploads/users/', $filename);
			$users->image = $filename;
           
        } 
        
        $users->name = $request->get('txtname');
        $users->email = $request->get('txtemail');
		if($request->get('txtpassword'))
		{
        $users->password = bcrypt($request->get('txtpassword'));         
		}
       // $users->image = $request->get('txtimage'); 
        $users->update(); 
        return redirect('/users')->with('success', 'user updated successfully');
    }

    public function update_status(Request $request, Users $users)
    {  
      
        $id=$request->get('id');

        $users = Users::find($id);
        $users->id = $id;
         $users->status = $request->get('value'); 
       // $users->image = $request->get('txtimage'); 
        $users->update(); 
        return redirect('/users')->with('success', 'user updated successfully');
    }

    public function add_fav(Request $request, Users $users)
    { 
        //$fav = Favourites::all();
        $fav = new Favourites([
            'product_id' => $request->get('pid'),
            'user_id' => Auth::user()->id
        ]);
       $fav->save();
        
     return redirect('/products')->with('success', 'Product is Favourited');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Users  $users
     * @return \Illuminate\Http\Response
     */
    public function destroy(Users $users,$id)
    {
        $users = Users::find($id);
        $users->delete();
        return redirect('/users')->with('success', 'User deleted successfully');
    }
}
