@extends('users.layouts.app')
 
@section('content')
    <div class="row">
        <div class="col-lg-11">
                <h2>Detail for {{ $stocks->name }}</h2>
        </div>
       
    </div>
    <table class="table table-bordered">
        <tr>
            <th>Product Name:</th>
            <td>{{ $stocks->product_name }}</td>
        </tr>
        <tr>
            <th>Supplier Name:</th>
            <td>{{ $stocks->supplier_name }}</td>
        </tr>
		  <tr>
            <th>Quantity:</th>
            <td>{{ $stocks->quantity }}</td>
        </tr>
		 <tr>
            <th>Created at:</th>
            <td>{{ $stocks->created_at }}</td>
        </tr>
		 <tr>
            <th>Updated at:</th>
            <td>{{ $stocks->updated_at }}</td>
        </tr>
		
		 
       
 
    </table>
@endsection