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
    <form action="/products/update/{{$products->id}}" method="POST" enctype="multipart/form-data">
          @method('PATCH')
        @csrf
		 <div class="form-group">
            <label for="txtusers">User:</label>
			<select class="form-control" name="txtusers">
			<option value="{{$products->u_id}}" selected>{{$products->user_name}}</option>
			 @foreach ($users as $user)
			<option value="{{$user->id}}">{{$user->name}}</option>
			 @endforeach
			</select>            
        </div>		
			 <div class="form-group">
            <label for="txtcat">Category:</label>
			<select class="form-control" readonly name="txtcat">
			<option value="{{Auth::user()->id}}" selected >{{Auth::user()->name}}</option>
			<option value="{{$products->cat_id}}" selected>{{$products->cat_name}}</option>
			 @foreach ($categories as $cat)
			<option value="{{$cat->id}}">{{$cat->name}}</option>
			 @endforeach
			</select>
            
        </div>
        <div class="form-group">
            <label for="txtname">Name:</label>
            <input type="text" class="form-control" id="txtname" placeholder="Enter  Name" value="{{$products->name}}" name="txtname">
        </div>
        <div class="form-group">
            <label for="txtcode">Code:</label>
            <input type="text" class="form-control" id="txtcode" placeholder="Enter UNIQUE Code" value="{{$products->code}}" name="txtcode">
        </div>
		
		 <div class="form-group">
            <label for="txtcost">Cost:</label>
            <input type="number" class="form-control" id="txtcost" placeholder="Enter COST" value="{{$products->cost}}" name="txtcost">
        </div>
		
		 <div class="form-group">
            <label for="txtdesc">Description:</label>
            <textarea  class="form-control" id="txtdesc" placeholder="Enter Description" name="txtdesc">{{$products->description}}</textarea>
        </div>

         <div class="form-group">
            <label for="image">Image:</label>
			<img src="{{ asset('uploads/products/')}}/{{$products->image }}" width="300">
            <input type="file" class="form-control" id="image"  name="image">
        </div>      
        <button type="submit" class="btn btn-default">Update</button>
    </form>
@endsection