@extends('users.layouts.app')
 
@section('content')
    <div class="row">
        <div class="col-lg-11">
                <h2>Users</h2>
        </div>
        <div class="col-lg-1">
            <a class="btn btn-primary" href="{{ url('users') }}"> Back</a>
        </div>
    </div>
    <table class="table table-bordered">
        <tr>
            <th>Name:</th>
            <td>{{ $users->name }}</td>
        </tr>
        <tr>
            <th>Email:</th>
            <td>{{ $users->email }}</td>
        </tr>
        <tr>
            <th>Status:</th>
            <td>{{ $users->status }}</td>
        </tr>
 
    </table>
@endsection