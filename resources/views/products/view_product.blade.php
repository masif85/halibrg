@extends('users.layouts.app')
 
@section('content')
<style>

a,
a:hover {
    text-decoration: none;
    color: inherit;
}

.section-products {
    padding: 80px 0 54px;
}


.section-products .single-product {
    text-align:center;
    margin-bottom: 26px;
}

.section-products .single-product .part-1 {
    text-align: center;
    position: relative;
    height: 0px;
    max-height: 290px;
    margin-bottom: 20px;  
    width: 80%;
    margin: 0 auto 0;  
}

.section-products .single-product .part-1::before {
        position: absolute;
        content: "";
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: -1;
        transition: all 0.3s;
}

.section-products .single-product:hover .part-1::before {
    transform: scale(1.2,1.2) rotate(5deg);
}


.section-products .single-product .part-1 .discount,
.section-products .single-product .part-1 .new {
    position: absolute;
    top: 15px;
    left: 20px;
    color: #ffffff;
    background-color: #fe302f;
    padding: 2px 8px;
    text-transform: uppercase;
    font-size: 0.85rem;
}

.section-products .single-product .part-1 .new {
    left: 0;
    background-color: #444444;
}

.section-products .single-product .part-1 ul {
    position: absolute;
    bottom: -41px;
    left: 20px;
    margin: 0;
    padding: 0;
    list-style: none;
    opacity: 0;
    transition: bottom 0.5s, opacity 0.5s;
}

.section-products .single-product:hover .part-1 ul {
    bottom: 30px;
    opacity: 1;
}

.section-products .single-product .part-1 ul li {
    display: inline-block;
    margin-right: 4px;
}
.section-products .single-product .part-1 ul li a {
    display: inline-block;
    width: 40px;
    height: 40px;
    line-height: 40px;
    background-color: #ffffff;
    color: #444444;
    text-align: center;
    box-shadow: 0 2px 20px rgb(50 50 50 / 10%);
    transition: color 0.2s;
}

.section-products .single-product .part-1 ul li a:hover {
    color: #fe302f;
}

.section-products .single-product .part-2 .product-title {
    text-align:center;
    font-size: 1rem;
}

.section-products .single-product .part-2 h4 {
    display: inline-block;
    font-size: 1rem;
}
</style>
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

    <div class="row">
        <div class="col-lg-10">
<section class="section-products">
                <div class="row">
                        <!-- Single Product -->
                         @foreach ($products as $pd)
                        <div class="col-md-6 col-lg-4 col-xl-3">
                  <div id="product-1" class="single-product">
                    <img src="{{ asset('uploads/products/')}}/{{$pd->image}}" width="250">
   <div class="part-1">
    <ul>
    <li><a href="#"><i class="fas fa-shopping-cart"></i></a></li>
    <li><a href="#"><i class="fas fa-heart add_fav"
 @if ($pd->fav_user_id)
 style="color: #fe302f"
   @endif
      data-prod="{{$pd->id}}"></i></a></li>
     </ul>
    </div>    
     <div class="part-2">
        <h3 class="product-title bg-gray py-2 px-3 mt-4">{{$pd->name}}</h3>
            <h4 class="product-price btn btn-primary btn-lg btn-flat">AED: {{$pd->cost}}</h4>
     </div>
    </div>
    </div>
    @endforeach
 </div>
  </div>
</div>
</section>
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
