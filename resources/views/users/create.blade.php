@extends('users.layouts.app')
 
@section('content')
    <div class="row">
        <div class="col-lg-11">
            <h2>Add New User</h2>
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
    <form action="/users/store" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="txtname">Name:</label>
            <input type="text" class="form-control" id="txtname" placeholder="Enter  Name" name="txtname">
        </div>
        <div class="form-group">
            <label for="txtemail">Email:</label>
            <input type="text" class="form-control" id="txtemail" placeholder="Enter Last Name" name="txtemail">
        </div>

         <div class="form-group">
            <label for="image">Image:</label>
            <input type="file" class="form-control" id="image"  name="image">
        </div>

        <div class="form-group">
            <label for="txtpassword">Password:</label>
            <input type="text" class="form-control" id="txtpassword" placeholder="Enter Last Name" name="txtpassword">
        </div>
        <button type="submit" class="btn btn-default">Submit</button>
    </form>
@endsection