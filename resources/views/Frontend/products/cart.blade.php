@extends('layouts.app')

@section('title','Ecommerce App| Cart')
@section('content')

@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if (session('kp1'))
    <div class="alert alert-danger alert-dismissible fade show"  role="alert">{{session('kp1')}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<section class="section-5 pt-3 pb-3 mb-2 bg-white">
    <div class="container">
        <div class="light-font">
            <ol class="breadcrumb primary-color mb-0">
                <li class="breadcrumb-item"><a class="text-white badge bg-primary text-decoration-none" style="font-size:17px" href="{{url('/Front')}}"><h4>Home</h4></a></li>

            </ol>
        </div>
    </div>
</section>
@if(Auth::check())
<section class="section-9 pt-4">
    <div class="col-md-6 mx-auto">  <!-- Add Bootstrap class for centering text -->
        <div class="card">
            <div class="card-header">
            
                <h2 class="mb-0  text-center" >Add To Cart</h2> <!-- Adjust the margins for better appearance -->
            </div>
        </div>
    </div>
    <br/>
    <div class="container">
        <a class="btn btn-primary float-end" href="{{url('/Front')}}">Back</a><br/>&nbsp;
        <div class="row">
            <div class="col-md-8">
                <div class="table-responsive">
                    <table class="table" id="cart">
                        <thead>
                            <tr>
                                <th>image</th>
                                <th>title</th>
                                <th>Quantity</th>
                                <th>selling_price</th>
                                <th></th>
                                <th>Total</th>
                                <th>Action</th>
                                
                            </tr>
                           
                        </thead>
                        <tbody>
                            @if (!empty($cart))
                                
                             @foreach ($cart as $item)


                            <tr style="font-size: 22px;">
                                <td>
                                    
                                    <div class="d-flex align-items-center ">
                                    
                                    @php
                                        $productImages = $item->products->productImages;
                                    @endphp

                                    @if ($productImages->isNotEmpty())
                                        <img class="card-img-top" src="{{ asset($productImages->first()->image) }}" style="width: 50%;">
                                    @else
                                        <span>No Image Available</span>
                                    @endif

                                      
                                    </div>
                                </td>
                                <td><span class="badge bg-primary">{{$item->name}}</span></td>
                                <td>{{$item->quantity}}</td>
                                <td>{{$item->selling_price}}</td> 
                                <td>
                                    <div class="input-group quantity mx-auto" style="width: 100px;">
                                        <div class="input-group-btn">
                                            <button style="border-radius: 20px;" class="btn btn-sm btn-light border btn-minus p-2 pt-1 pb-1 sub" data-id="{{$item->id}}">
                                                <i class="fa fa-minus"></i>
                                            </button>
                                        </div>
                                        <input type="text" class="form-control form-control-sm  border-0 text-center" value="{{$item->quantity}}">
                                        <div class="input-group-btn">
                                            <button style="border-radius: 20px;" class="btn btn-sm btn-light border btn-plus p-2 pt-1 pb-1 add" data-id="{{$item->id}}">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    {{$item->selling_price*$item->quantity}}
                                </td>
                                <td>
                                    <form action="{{ url('removeCart') }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="id" value="{{ $item->id }}">
                                        <button type="submit"  class="badge bg-light border text-decoration-none text-black">Remove</button>
                                    </form>
                                </td>
                              
                             
                            </tr>
                            @endforeach                          
                            @endif
                        </tbody>
                        <td colspan="7">
                            @if(empty($item))
                            <span class="badge bg-danger" style="font-size:20px;">No Item Found in Cart</span>
                            @endif
                        </td>
                    </table>
                </div>

                @if(Session::has('coupon'))
               
                @else
               

                <div class="shopping_discount">
                    <h5>Apply For Coupens</h5><br/>
                    <div class="col-md-6">
                        @if(session('error') && Session::has('coupon_name'))
                        <div class="invalid-feedback">
                            {{ session('error') }}
                        </div>
                    @endif
                           
                    
                      
                    </div>
                    <form action="{{ url('coupon/apply')}}" method="POST" class="d-flex align-items-end">
                        @csrf
                       
                        <br/>
                        <input type="text" name="coupon_name" placeholder="Enter Your Coupon Code" class="form-control @error('coupon_name') is-invalid @enderror" style="width:29vh;">
                   
                        <button type="submit" class="btn btn-primary float-end"  style="margin-top: -40px;">Apply Coupon</button>
                       
                        
                    </form>
                </div>
                @endif
            
            </div>
     
        
            <div class="col-md-4">
                <div class="card cart-summery">
                    <div class="sub-title">
                        <h2 class="bg-white">Cart Summary</h3>
                    </div>
                    <div class="card-body">
                        @php
                        $cartTotal =0;
                        @endphp
                        @foreach($cart as $item)
                            @php
                                $total = $item->selling_price * $item->quantity;
                                $cartTotal += $total
                            @endphp
                        
                        @endforeach
                        <div class="row">
                            <div class="col-md-12">
                                <h4>Total:</h4>
                                <span class="badge bg-light border text-black" style="font-size:20px;">{{$cartTotal}}</span>
                            </div>
                        </div>
                        <div class="row mt-3" style="font-size: 25px;">
                            <div class="col-md-6">
                                <h4>Discount:</h4>
                                @if(Session::has('coupon'))
                                  
                                    <span class="badge bg-light border text-black px-3" >{{session()->get('coupon')['discount']}}% ({{$discount = $cartTotal * session()->get('coupon')['discount'] / 100 }} Rs.)</span><br/><br/>
                                    <span style="font-size:20px;font-weight:bold;">Coupon:</span><span class="">{{session()->get('coupon')['coupon_name']}}&nbsp;<a href="{{url('coupon/destroy')}}" class="btn btn-danger"style="text-decoration: none;font-size:10px;">X</a></span>
                                @else
                                    <span class="badge bg-light border text-black px-3">0%</span>
                                @endif
                            </div>
                            <div class="col-md-6">
                                <h4>Discount Price:</h4>
                                @if(Session::has('coupon'))

                                    <span class="badge bg-light border text-black" >{{$cartTotal - $discount}}Rs.</span>
                                
                                @else
                                    <span class="badge bg-light border text-black" >{{$cartTotal}}Rs.</span>
                                @endif
                            </div>
                        </div>
                        <div class="pt-5">
                            @if($cart->count() > 0)
                                <a style="font-size:17px;font-weight:bold;" class="btn-light border btn btn-block w-100" href="{{ url('checkout') }}">Proceed to Checkout</a>
                            @else
                                <p class="text-danger badge bg-light d-none d-md-block" style="font-size: 13px;font-weight:bold;">Please add items to the cart before proceeding to checkout.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</section>
@endsection
@section('customJs')
   <script>
     $(document).ready(function () {
            toastr.options = {
                closeButton: true,
                progressBar: true,
                positionClass: 'toast-top-right',
                showDuration: 300,
                hideDuration: 1000,
                timeOut: 5000,
                extendedTimeOut: 1000,
            };


        toastr.options.toastClass = 'custom-toast';
        
    $('.add').click(function(){
      var qtyElement = $(this).parent().prev(); // Qty Input
      var qtyValue = parseInt(qtyElement.val());
      
     //   var productQuantity = "{{ isset($item) ? $item->products->quantity : 0 }}";

        if (qtyValue < 10)  {
        qtyElement.val(qtyValue+1);

        var id = $(this).data('id');
        var newQty = qtyElement.val();
        updateCart(id,newQty);

        $(this).attr('disabled', 'disabled');

      }else {
       
        toastr.error('Out of stock');
        }
    });

    $('.sub').click(function(){
      var qtyElement = $(this).parent().next();
      var qtyValue = parseInt(qtyElement.val());
      if (qtyValue > 1) {

        qtyElement.val(qtyValue-1);

        var id = $(this).data('id');
        var newQty = qtyElement.val();
        updateCart(id,newQty);

        $(this).parent().next().find('.add').removeAttr('disabled');
      }
      if (qtyValue - 1 < 1) {
        $(this).attr('disabled', 'disabled');
    }
     
    });


    function updateCart(id, quantity) {
    $.ajax({
        url: '{{ route("front.updateCart") }}',
        type: 'post',
        data: {
            id: id,
            quantity: quantity,
            _token: '{{ csrf_token() }}' // Add this line to include CSRF token
        },
        dataType: 'json',
        success: function(response){
            if(response.status == true){
                window.location.reload();
            }
        }
    });

}
     });
</script>
@endif
<style>
    .custom-toast {
        background-color: #ff4d4d; /* Red background color */
        color: #fff; /* White text color */
        border-radius: 20px; /* Optional: Add border-radius for rounded corners */
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.2); /* Optional: Add box-shadow for a subtle effect */
        font-size:30px;
        margin-left: 82%;
        width: 10%;
        height: 100px;
        margin-top: -55vh;
    }

    .custom-toast button.toast-close-button {
        color: #fff; 
        background-color: red/* Close button text color */
    }
</style>

@endsection 


