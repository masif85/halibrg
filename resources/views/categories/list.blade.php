@extends('users.layouts.app')
 
@section('content')
    <div class="row">
        <div class="col-lg-11">
                <h2>Categories</h2>
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
            <th>Name</th>            
            <th width="280px">Action</th>
        </tr>
        @php
            $i = 0;
        @endphp
        @foreach ($categories as $cat)       
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $cat->name }}</td>            
                
                <td>
                    <form action="/categories/destroy/{{$cat->id}}" method="POST">
                        <a class="btn btn-info" href="/categories/show/{{$cat->id}}">Show</a>
                        <a class="btn btn-primary" href="/categories/edit/{{$cat->id}}">Edit</a>
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
    
@endsection
