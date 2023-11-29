@extends('stocks.layouts.app')
 
@section('content')
    <div class="row">
        <div class="col-lg-11">
            <h2>Add New Stock</h2>
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
    <form action="/stocks/store" method="POST" enctype="multipart/form-data">
        @csrf
		 <div class="form-group">
            <label for="txtproduct">Select Product:</label>
			<select class="form-control" name="txtproduct">
			 @foreach ($products as $product)
			<option value="{{$product->id}}">{{$product->name}}</option>
			 @endforeach
			</select>           
        </div>				
        <div class="form-group">
            <label for="txtname">Supplier Name:</label>
            <input type="text" class="form-control" id="txtname" placeholder="Enter Supplier Name" name="txtname">
        </div>
        <div class="form-group">
            <label for="txtcode">Quantity:</label>
            <input type="number" class="form-control" id="txtcode" placeholder="Enter Qauntity" name="txtquantity">
        </div>	      
        <button type="submit" class="btn btn-default">Submit</button>
    </form>
@endsection