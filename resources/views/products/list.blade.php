@extends('users.layouts.app')
 
@section('content')
    <div class="row">
        <div class="col-lg-11">
                <h2>Products</h2>
        </div>
        <div class="col-lg-1">
            <a class="btn btn-success" href="products/create">Add</a>
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
            <th>Category</th>
            <th>Name</th>
            <th>Email</th>
            <th>Status</th>
            <th width="280px">Action</th>
        </tr>
        @php
            $i = 0;
        @endphp
        @foreach ($products as $product)
   
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $product->category }}</td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->code }}</td>
                
                <td>
                    <form action="/products/destroy/{{$product->id}}" method="POST">
                        <a class="btn btn-info" href="/products/show/{{$product->id}}">Show</a>
                        <a class="btn btn-primary" href="/users/edit/{{$product->id}}">Edit</a>
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
@endsection
