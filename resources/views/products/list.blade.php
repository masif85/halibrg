@extends('users.layouts.app')
 
@section('content')
    <div class="row">
        <div class="col-lg-11">
                <h2>Products</h2>
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
            <th>Category</th>
            <th>Name</th>
             <th>Stock Quantity</th>
            <th>Code</th>
           <th>Price</th>
            <th width="280px">Action</th>
        </tr>
        @php
            $i = 0;
        @endphp
        @foreach ($products as $product)
   
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $product->cat_name }}</td>
                <td>{{ $product->name }}</td>
                 <td>{{ $product->quantity }}</td>
                <td>{{ $product->code }}</td>
                 <td>{{ $product->cost }}</td>
                <td>
                    <form action="/products/destroy/{{$product->id}}" method="POST">
                        <a class="btn btn-info" href="/products/show/{{$product->id}}">Show</a>
                        <a class="btn btn-primary" href="/products/edit/{{$product->id}}">Edit</a>

                         <a class="btn btn-success bi bi-bookmark-check-fill add_fav" data-prod='{{$product->id}}'><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bookmark-check-fill" viewBox="0 0 16 16">
                         <path fill-rule="evenodd" d="M2 15.5V2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.74.439L8 13.069l-5.26 2.87A.5.5 0 0 1 2 15.5m8.854-9.646a.5.5 0 0 0-.708-.708L7.5 7.793 6.354 6.646a.5.5 0 1 0-.708.708l1.5 1.5a.5.5 0 0 0 .708 0l3-3"/>
                        </svg>Favourite</a>

                        @csrf
                        @method('DELETE')
                        <!--<button type="submit" class="btn btn-danger">Delete</button> -->
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
    <script>
        $(".add_fav").click(function(){
            var pid=$(this).attr("data-prod");            
            var url = "/users/add_fav/"; 
            $.ajax({
                url: url,
                type:"POST",
                data:{pid:pid,_token: "{{ csrf_token() }}"},
                dataType: 'json',       
                success: function(res) {
                //location.reload();
                }
            });
});
    </script>
@endsection
