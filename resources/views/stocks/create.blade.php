@extends('users.layouts.app')
 
@section('content')
    <div class="row">
        <div class="col-lg-11">
            <h2>Add New Stock</h2>
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
    <form action="/stocks/store" method="POST" enctype="multipart/form-data">
        @csrf
		 <div class="form-group">
            <label for="txtproduct">Select Product:</label>
			<select class="form-control" required name="txtproduct">
			 @foreach ($products as $product)
			<option value="{{$product->id}}">{{$product->name}}</option>
			 @endforeach
			</select>           
        </div>				
        <div class="form-group">
            <label for="txtname">Supplier Name:</label>
            <input type="text" class="form-control" required id="txtname" placeholder="Enter Supplier Name" name="txtname[]">
        </div>
        <div class="form-group">
            <label for="txtquantity">Quantity:</label>
            <input type="number" class="form-control" required id="txtquantity" placeholder="Enter Qauntity" name="txtquantity[]">
        </div>	
          <div class="form-group">
           
            <button type="button" class="btn btn-success add_more">Add More +</button>
        </div> 
        <div class="colmd_1">
        </div>    
        <button type="submit" class="btn btn-default">Submit</button>
        
    </form>
<script>
    var numbers=1;
    var sar=1;
    $(".add_more").click(function(){
   var textz='<div id="container_'+sar+'"><div class="form-group" ><div class="cleafix">&nbsp;</div><label for="txtname">Supplier Name '+sar+':</label><input type="text" required class="form-control" id="txtname" placeholder="Enter Supplier Name" name="txtname[]"></div><div class="form-group"><label for="txtquantity">Supplier '+sar+' Quantity:</label><input type="number" required class="form-control" id="txtquantity" placeholder="Enter Qauntity" name="txtquantity[]"><button type="button" class="btn btn-info btn-flat" onClick="removeItem('+sar+');">- Remove</button></div> </div>';
       sar=sar+1;
       $(".colmd_"+numbers).append(textz); 
    });      
  

    function removeItem(container)  
    {
        $("#container_"+container).remove();
       
    }
</script>


@endsection