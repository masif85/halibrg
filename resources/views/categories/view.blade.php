@extends('categories.layouts.app')
 
@section('content')
    <div class="row">
        <div class="col-lg-11">
                <h2>{{$categories->name}}</h2>
        </div>
        <div class="col-lg-1">
            <a class="btn btn-primary" href="{{ url('categories') }}"> Back</a>
        </div>
    </div>
    <table class="table table-bordered">
        <tr>
            <th>Category Name:</th>
            <td>{{ $categories->name }}</td>
			<th>Created at:</th>
            <td>{{ $categories->created_at }}</td>
			<th>Updated at:</th>
            <td>{{ $categories->updated_at }}</td>
        </tr>  
    </table>
@endsection