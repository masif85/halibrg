@extends('users.layouts.app')
 
@section('content')
    <div class="row">
        <div class="col-lg-11">
                <h2>{{$categories->name}}</h2>
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