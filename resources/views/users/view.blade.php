@extends('users.layouts.app')
 
@section('content')
    <div class="row">
        <div class="col-lg-11">
                <h2>Users</h2>
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
            <th>Image:</th>
            <td><img src="{{ asset('uploads/users/')}}/{{$users->image }}" width="300">



            </td>
        </tr>
        <tr>
            <th>Status:</th>
            <td>@if ($users->status == 1) 
            Active
            @else
            In Active
            @endif
          </td>
        </tr>
 
    </table>
@endsection