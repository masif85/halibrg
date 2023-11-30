@extends('users.layouts.app')
 
@section('content')
    <div class="row">
        <div class="col-lg-11">
                <h2>Detail for {{ $product_data->name }}</h2>
        </div>
       
    </div>
    <table class="table table-bordered">
	 @php
            $sr = 1;
			
        @endphp
	 @foreach ($stocks as $stock)
     
        <tr>
            <th> Supplier Name: {{$sr}}</th>
            <td>{{ $stock->supplier_name }}</td>
        </tr>
		  <tr>
            <th>Quantity:</th>
            <td>{{ $stock->quantity }}</td>
        </tr>
		<tr>
            <th>Date:</th>
            <td>{{ $stock->date }}</td>
        </tr>
		 <tr>
            <th>Created at:</th>
            <td>{{ $stock->created_at }}</td>
        </tr>
		 <tr>
            <th>Updated at:</th>
            <td>{{ $stock->updated_at }}</td>
        </tr>
		 <tr>
            <th colspan="2">&nbsp;</th>
            
        </tr>
		<div class="clearfix separator"></div>
		 @php
            $sr++;
        @endphp
		@endforeach
		 
       
 
    </table>
@endsection