@extends('users.layouts.app')
 
@section('content')
    <div class="row">
        <div class="col-lg-11">
                <h2>Users</h2>
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
            <th>Email</th>
            <th>Status</th>
            <th width="280px">Action</th>
        </tr>
        @php
            $i = 0;
        @endphp
        @foreach ($users as $user)
        @if($user->status==1)
        @php
        $check='checked';
        @endphp
        @else
        @php
        $check='';
        @endphp
        @endif
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td><input type="checkbox" {{$check}} id="{{$user->id}}" class="update_status" </td>
                <td>
                    <form action="/users/destroy/{{$user->id}}" method="POST">
                        <a class="btn btn-info" href="/users/show/{{$user->id}}">Show</a>
                        <a class="btn btn-primary" href="/users/edit/{{$user->id}}">Edit</a>
                        @csrf
                        @method('DELETE')
                      <!--  <button type="submit" class="btn btn-danger">Delete</button> -->
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
    <script>
$(".update_status").click(function(){

    var id=$(this).attr('id');  
    if ($(this).is(":checked"))
        {
          var value=1;
        }
            else
        {
            
            var value=0;
        }
    

    var url = "/users/update_status/"; 

    $.ajax({
        url: url,
        type:"POST",
        data:{id:id,value:value,_token: "{{ csrf_token() }}"},
        dataType: 'json',       
        success: function(res) {
        //location.reload();
        }
    });
});
    </script>
@endsection
