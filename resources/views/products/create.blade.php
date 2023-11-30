@extends('users.layouts.app')
 
@section('content')
    <div class="row">
        <div class="col-lg-11">
            <h2>Add New Product</h2>
        </div>
        
    </div>
 
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="/products/store" method="POST" enctype="multipart/form-data">
        @csrf
		 <div class="form-group">
            <label for="txtusers">User:</label>
			<select class="form-control" readonly name="txtusers">
			<option value="{{Auth::user()->id}}" selected >{{Auth::user()->name}}</option>
			
			 @foreach ($users as $user)
			<option value="{{$user->id}}">{{$user->name}}</option>
			 @endforeach
			</select>
            
        </div>
		
			 <div class="form-group">
            <label for="txtcat">Category:</label>
			<select class="form-control" name="txtcat">
			 @foreach ($categories as $cat)
			<option value="{{$cat->id}}">{{$cat->name}}</option>
			 @endforeach
			</select>
            
        </div>
        <div class="form-group">
            <label for="txtname">Name:</label>
            <input type="text" class="form-control" required id="txtname" placeholder="Enter  Name" name="txtname">
        </div>
        <div class="form-group">
            <label for="txtcode">Code:</label>
            <input type="text" class="form-control" required id="txtcode" placeholder="Enter UNIQUE Code" name="txtcode">
        </div>
		
		 <div class="form-group">
            <label for="txtcost">Cost:</label>
            <input type="number" class="form-control" required id="txtcost" placeholder="Enter COST" name="txtcost">
        </div>
		
		 <div class="form-group">
            <label for="txtdesc">Description:</label>
            <textarea  class="form-control" id="txtdesc" required placeholder="Enter Description" name="txtdesc"></textarea>
        </div>

         <div class="form-group">
            <label for="image">Image:</label>
            <input type="file" class="form-control" required id="image"  name="image">
        </div>      
        <button type="submit" class="btn btn-default">Submit</button>
    </form>
@endsection