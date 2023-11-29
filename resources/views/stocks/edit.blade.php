@extends('stocks.layouts.app')
 
@section('content')
    <div class="row">
        <div class="col-lg-11">
            <h2>Add New Product</h2>
        </div>
        <div class="col-lg-1">
            <a class="btn btn-primary" href="{{ url('stocks') }}"> Back</a>
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
    <form action="/stocks/update/{{$stocks->id}}" method="POST" enctype="multipart/form-data">
          @method('PATCH')
        @csrf
		
			 <div class="form-group">
            <label for="txtproduct">Product:</label>
			<select class="form-control"  name="txtproduct">
			<option value="{{$stocks->product_id}}" selected>{{$stocks->product_name}}</option>
			 @foreach ($products as $product)
			<option value="{{$product->id}}">{{$product->name}}</option>
			 @endforeach
			</select>
            
        </div>
         <div class="form-group">
            <label for="txtname">Supplier Name:</label>
            <input type="text" class="form-control" id="txtname" placeholder="Enter Supplier Name" disabled value="{{$stocks->supplier_name}}" name="txtname">
        </div>
        <div class="form-group">
            <label for="txtquantity">Quantity:</label>
            <input type="number" class="form-control" id="txtquantity" placeholder="Enter Qauntity" disabled value="{{$stocks->quantity}}" name="txtquantity">
        </div>	     
        <button type="submit" class="btn btn-default">Update</button>
    </form>
@endsection