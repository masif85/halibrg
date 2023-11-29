@extends('users.layouts.app')
 
@section('content')
    <div class="row">
        <div class="col-lg-11">
            <h2>Add New Student</h2>
        </div>
        <div class="col-lg-1">
            <a class="btn btn-primary" href="{{ url('users') }}"> Back</a>
        </div>
    </div>
 
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('users.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="txtName">Name:</label>
            <input type="text" class="form-control" id="txtName" placeholder="Enter  Name" name="txtName">
        </div>
        <div class="form-group">
            <label for="txtEmail">Email:</label>
            <input type="text" class="form-control" id="txtEmail" placeholder="Enter Last Name" name="txtEmail">
        </div>
        <div class="form-group">
            <label for="txtPassword">Address:</label>
            <input type="text" class="form-control" id="txtPassword" placeholder="Enter Last Name" name="txtPassword">
        </div>
        <button type="submit" class="btn btn-default">Submit</button>
    </form>
@endsection