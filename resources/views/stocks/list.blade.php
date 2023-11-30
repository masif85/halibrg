@extends('stocks.layouts.app')
 
@section('content')
    <div class="row">
        <div class="col-lg-11">
                <h2>Stocks</h2>
        </div>
        <div class="col-lg-1">
            <a class="btn btn-success" href="stocks/create">Add</a>
        </div>
    </div>
 
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
 
    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Product</th>
            <th>Supplier</th>
            <th>Quantity</th>           
            <th width="280px">Action</th>
        </tr>
        @php
            $i = 0;
        @endphp
        @foreach ($stocks as $stock)
   
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $stock->product_name }}</td>
                <td>{{ $stock->supplier_name }}</td>
                <td>{{ $stock->quantity }}</td>                
                <td>
                    <form action="/stocks/destroy/{{$stock->id}}" method="POST">
                        <a class="btn btn-info" href="/stocks/show/{{$stock->product_id}}">Show</a>
                        <a class="btn btn-primary" href="/stocks/edit/{{$stock->product_id}}">Edit</a>
                        @csrf
                        @method('DELETE')
                       <!-- <button type="submit" class="btn btn-danger">Delete</button> -->
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
@endsection
