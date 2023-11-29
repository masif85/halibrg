@extends('users.layouts.app')
 
@section('content')
    <div class="row">
        <div class="col-lg-11">
                <h2>Detail for {{ $products->name }}</h2>
        </div>
        <div class="col-lg-1">
            <a class="btn btn-primary" href="{{ url('products') }}"> Back</a>
        </div>
    </div>
    <table class="table table-bordered">
        <tr>
            <th>USER:</th>
            <td>{{ $products->user_name }}</td>
        </tr>
        <tr>
            <th>Product Name:</th>
            <td>{{ $products->name }}</td>
        </tr>
		  <tr>
            <th>Category:</th>
            <td>{{ $products->cat_name }}</td>
        </tr>
		
		 <tr>
            <th>Code:</th>
            <td>{{ $products->code }}</td>
        </tr>
		 <tr>
            <th>Cost:</th>
            <td>{{ $products->cost }}</td>
        </tr>
		 <tr>
            <th>Description:</th>
            <td>{{ $products->description }}</td>
        </tr>
          <tr>
            <th>Image:</th>
            <td><img src="{{ asset('uploads/products/')}}/{{$products->image }}" width="300">



            </td>
        </tr>
       
 
    </table>
@endsection