@extends('categories.layouts.app')
 
@section('content')
    <div class="row">
        <div class="col-lg-11">
            <h2>Update {{ $categories->name }}</h2>
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
    <form method="post" action="/categories/update/{{$categories->id}}" enctype="multipart/form-data">
        @method('PATCH')
        @csrf
        <div class="form-group">
            <label for="txtname">Name:</label>
            <input type="text" class="form-control" id="txtname" placeholder="Enter Name" name="txtname" value="{{ $categories->name }}">
        </div>
        
        <button type="submit" class="btn btn-default">Update</button>
    </form>
@endsection