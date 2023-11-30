@extends('users.layouts.app')
 
@section('content')
    <div class="row">
        <div class="col-lg-11">
            <h2>Add New Category</h2>
        </div>
        <div class="col-lg-1">
            <a class="btn btn-primary" href="{{ url('categories') }}"> Back</a>
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
    <form action="/categories/store" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="txtname">Name:</label>
            <input type="text" class="form-control" id="txtname" placeholder="Enter  Name" name="txtname">
        </div>
 
        <button type="submit" class="btn btn-default">Submit</button>
    </form>
@endsection