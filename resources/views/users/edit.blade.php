@extends('users.layouts.app')
 
@section('content')
    <div class="row">
        <div class="col-lg-11">
            <h2>Update</h2>
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
    <form method="post" action="/users/update/{{$users->id}}" enctype="multipart/form-data">
        @method('PATCH')
        @csrf
        <div class="form-group">
            <label for="txtname">Name:</label>
            <input type="text" class="form-control" required id="txtname" required placeholder="Enter Name" name="txtname" value="{{ $users->name }}">
        </div>
        <div class="form-group">
            <label for="txtemail">Email:</label>
            <input type="text" class="form-control" required id="txtemail" required placeholder="Enter Email" name="txtemail" value="{{ $users->email }}">
        </div>
           <div class="form-group">
            <label for="image">Image:</label>
            <input type="file" class="form-control"  id="image"  name="image">
        </div>

        <div class="form-group">
            <label for="txtpassword">Password:</label>
            <input type="password" class="form-control"  id="txtpassword" required placeholder="Enter Password" name="txtpassword" value="">
        </div>        
        <button type="submit" class="btn btn-default">Submit</button>
    </form>
@endsection