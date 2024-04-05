@extends('layouts.master')
@section('title')
@section('content')
<br/>
<div class="row" style="text-align: center;">
    &nbsp;&nbsp;
    <style>
        @keyframes borderAnimation {
          0% {
            border-color: #2193b0;
          }
          25% {
            border-color: #6dd5ed;
          }
          50% {
            border-color: #ff9a8b;
          }
          75% {
            border-color: #ff6a88;
          }
          100% {
            border-color: #ff99ac;
          }
        }
    
        @keyframes gradientEffect {
          0% {
            background-position: 0% 50%;
          }
          50% {
            background-position: 100% 50%;
          }
          100% {
            background-position: 0% 50%;
          }
        }
        </style>
    <div class="breadcrumb">
        {{-- <section class="container"><br/> --}}
            &nbsp;&nbsp; &nbsp; <div style="animation: borderAnimation 2s linear infinite; text-align: center;"">
                <span style="background: linear-gradient(45deg, #2193b0, #6dd5ed, #ff9a8b, #ff6a88, #ff99ac, #f6d365, #fda085, black); background-size: 200% 200%; -webkit-text-fill-color: transparent; -webkit-background-clip: text; animation: gradientEffect 5s ease-in-out infinite; font-size: 2em; display: block;">
                    👍  {{ Auth::user()->name }}, Welcome To The Dashboard!!👍<br/>
               
                </span><br/>
            </div>
        {{-- </section> --}}
    </div>
    @if(Auth::check() && Auth::user()->role_as == 1)
    
    &nbsp;  &nbsp;&nbsp;  &nbsp;&nbsp;  &nbsp;&nbsp;&nbsp;<div></div>&nbsp;&nbsp;  &nbsp;&nbsp;  &nbsp;&nbsp;&nbsp; <div class="col-md-2">
        <div class="card">
            <div class="card-header">
         
                <h4>Total Categories</h4>
                @if(Auth::check())
                @if($category > 0)
                <span class="badge bg-secondary px-3 py-2" style="font-size: 20px;"><a href="{{route('categories.index')}}" class="text-white text-decoration-none"> {{$category }}</a></span>
                @else
                <    <span class="badge bg-danger px-3 py-2" style="font-size: 20px;">X</span>
                @endif
                @endif
            </div>
        </div><br/>
    </div> 
    <div class="col-md-2">
        <div class="card">
            <div class="card-header">
              
                <h4>Total Products</h4>
                @if($products > 0)
                <a href="{{route('products.index')}}" style="text-decoration: none;color:black">  <span class="badge bg-secondary px-3 py-2" style="font-size: 20px;">{{$products}}</span></a></h4>
                @else
                <span class="badge bg-danger px-3 py-2" style="font-size: 20px;">X</span>
                @endif
                
            </div>
        </div>
    </div>    
    <div class="col-md-2">
        <div class="card">
            <div class="card-header">
                
                <h4>Total Brands</h4>
                @if($brands > 0)
                <h4><a href="{{route('brands.index')}}" style="text-decoration: none;color:black">      <span class="badge bg-secondary px-3 py-2 "  style="font-size: 20px;">{{$brands}}</span></a></h4>
          
                @else
                <span class="badge bg-danger px-3 py-2" style="font-size: 20px;">X</span>
                @endif
            </div>
        </div>
    </div>    
    <div class="col-md-2">
       <div class="card">
            <div class="card-header">
              
                <h4>Total Login</h4>
                @if($user > 0)
                <h4><a href="{{route('users.index')}}" style="text-decoration: none;color:black"><span class="badge bg-secondary px-3 py-2 "  style="font-size: 20px;">{{$user}}</span></a></h4>
          
                @else
                <span class="badge bg-danger px-3 py-2" style="font-size: 20px;">X</span>
                @endif
            </div>
        </div>
    </div>  
     <div class="col-md-2">
        <div class="card">
            @if(Auth::user()->role_as =='1')
            <div class="card-header">
             
                <h4>Total Admin</h4>
                @if($role > 0)
                <h4><a href="{{route('users.index')}}" style="text-decoration: none;color:black">      <span class="badge bg-secondary px-3 py-2 "  style="font-size: 20px;">{{$role}}</span></a></h4>
          
                @else
                <span class="badge bg-danger px-3 py-2" style="font-size: 20px;">X</span>
                @endif

                
            </div>
            @endif
        </div>
    </div> 
    <div></div>&nbsp;&nbsp;  &nbsp;&nbsp;  &nbsp;&nbsp;&nbsp; <div></div>&nbsp;&nbsp;  &nbsp;&nbsp;  &nbsp;&nbsp;&nbsp;
    <div class="col-md-2">
        <div class="card">
            @if(Auth::user()->role_as =='1')
            <div class="card-header">
                <h4>Total Employee</h4>
                @if($employee > 0)
                <h4><a href="{{route('users.index')}}" style="text-decoration: none;color:black">      <span class="badge bg-secondary px-3 py-2 "  style="font-size: 20px;">{{$employee}}</span></a></h4>
                @else
                <span class="badge bg-danger px-3 py-2" style="font-size: 20px;">X</span>
                @endif
                
            </div>
            @endif
        </div>
    </div> 
       
    <div class="col-md-2">
        <div class="card">
            <div class="card-header">
                <h4>Total Customer</h4>
                @if(Auth::check())
                @if($customer > 0)
                <span class="badge bg-secondary px-3 py-2" style="font-size: 20px;"><a href="{{route('users.index')}}" class="text-white text-decoration-none"> {{$customer }}</a></span>
                @else
                <span class="badge bg-danger px-3 py-2" style="font-size: 20px;">X</span>
                @endif
                @endif
                
            </div>
        </div>
    </div>    
    <div class="col-md-2">
        <div class="card">
            <div class="card-header">
              <h4>Total Cart</h4>
              @if(Auth::check())
              @if($cart > 0)
              <span class="badge bg-secondary px-3 py-2" style="font-size: 20px;"><a href="{{route('carts.index')}}" class="text-white text-decoration-none"> {{$cart }}</a></span>
              @else
              <span class="badge bg-danger px-3 py-2" style="font-size: 20px;">X</span>
              @endif
              @endif
              
            </div>
        </div><br/>
    </div>  

    <div class="col-md-2" style="margin-left: 10PX;">
        <div class="card">
            <div class="card-header">
              <h4>Total Product Order</h4>
              

                @if(Auth::check())
               @if($orders > 0)
               <span class="badge bg-secondary px-3 py-2" style="font-size: 20px;"><a href="{{route('orders.index')}}" class="text-white text-decoration-none"> {{$orders }}</a></span>
               @else
               <span class="badge bg-danger px-3 py-2" style="font-size: 20px;">X</span>
               @endif
               @endif
            </div>
        </div>
    </div>    &nbsp;&nbsp;&nbsp;
    <div class="col-md-2">
        <div class="card">
            <div class="card-header">

              <h4>Total orderItem</h4>
               @if(Auth::check())
               @if($orderItem > 0)
               <span class="badge bg-secondary px-3 py-2" style="font-size: 20px;"><a href="{{route('orders.index')}}" class="text-white text-decoration-none"> {{$orderItem }}</a></span>
               @else
               <span class="badge bg-danger px-3 py-2" style="font-size: 20px;">X</span>
               @endif
               @endif
            </div>
        </div>
    </div>    
    <div></div>&nbsp;&nbsp;  &nbsp;&nbsp;  &nbsp;&nbsp;&nbsp; <div></div>&nbsp;&nbsp;  &nbsp;&nbsp;  &nbsp;&nbsp;&nbsp;
    <div class="col-md-2">
        <div class="card">
            <div class="card-header">
                <h4><a href="{{route('coupons.index')}}" style="text-decoration: none;color:black">Total  Coupens</a>
                </h4>
                <span class="badge bg-secondary px-3 py-2 "  style="font-size: 20px;">{{$coupon}}</span>
            </div>
        </div>
    </div>    
    <div class="col-md-2">
        <div class="card">
            <div class="card-header">
                @if($Active)
                    <h4><a href="{{ route('coupons.index') }}" style="text-decoration: none; color: black">Active Coupons</a></h4>
                @else
                <span class="badge bg-secondary px-3 py-2" style="font-size: 20px;">X</span>
                @endif
                <span class="badge bg-secondary px-3 py-2" style="font-size: 20px;">{{ $Active }}</span>
            </div>
        </div>
    </div>
    
    <div class="col-md-2">
        <div class="card">
            <div class="card-header">
                <h4>Inactive Coupons</h4>
                @if(Auth::check())
                @if($InActive > 0)
                <span class="badge bg-secondary px-3 py-2" style="font-size: 20px;"><a href="{{route('coupons.index')}}" class="text-white text-decoration-none"> {{$InActive }}</a></span>
                @else
                <span class="badge bg-danger px-3 py-2" style="font-size: 20px;">X</span>
                @endif
                @endif
               

            </div>
        </div>
        <br/>
    </div>

    <div class="col-md-2">
        <div class="card">
            <div class="card-header">
                 <h4>Website Changes</a>
                </h4> 
           
                @if(Auth::check())
                @if($setting > 0)
                <span class="badge bg-secondary px-3 py-2" style="font-size: 20px;"><a href="{{url('admin/settings')}}" class="text-white text-decoration-none"> {{$setting }}</a></span>
                @else
                <span class="badge bg-danger px-3 py-2" style="font-size: 20px;">X</span>
                @endif
                @endif
            </div>
        </div>
    </div>    
   
    <div class="col-md-2">
        <div class="card">
            <div class="card-header">
                <h4>Total Comments</h4>
                @if(Auth::check())
                @if($comment > 0)
                <span class="badge bg-secondary px-3 py-2" style="font-size: 20px;"><a href="{{route('comments.index')}}" class="text-white text-decoration-none">{{ $comment }}</a></span>
                @else
                <span class="badge bg-danger px-3 py-2" style="font-size: 20px;">X</span>
                @endif
                @endif
            </div>
        </div>
    </div><div></div>&nbsp;&nbsp;  &nbsp;&nbsp;  &nbsp;&nbsp;&nbsp; <div></div>&nbsp;&nbsp;  &nbsp;&nbsp;  &nbsp;&nbsp;&nbsp;
    <div class="col-md-2">
        <div class="card">
            <div class="card-header">
                <h4>Total Wishlist</h4>
                @if(Auth::check())
                @if($totalwishlist > 0)
                <span class="badge bg-secondary px-3 py-2" style="font-size: 20px;"><a href="{{route('wishlists.index')}}" class="text-white text-decoration-none"> {{$totalwishlist }}</a></span>
                @else
                <span class="badge bg-danger px-3 py-2" style="font-size: 20px;">X</span>
                @endif
                @endif
            </div>
        </div>
    </div>
    <div class="col-md-2">
        <div class="card">
            <div class="card-header">
                <h4>Delivered Order</h4>
                @if(Auth::check())
                @if($deliveredorder > 0)
                <span class="badge bg-secondary px-3 py-2" style="font-size: 20px;"><a href="{{route('orders.index')}}" class="text-white text-decoration-none"> {{$deliveredorder }}</a></span>
                @else
                <span class="badge bg-danger px-3 py-2" style="font-size: 20px;">X</span>
                @endif
                @endif
            </div>
        </div>
    </div>
    <div class="col-md-2">
        <div class="card">
            <div class="card-header">
                <h4>Pending Order</h4>
                @if(Auth::check())
                @if($pendingorder > 0)
                <span class="badge bg-secondary px-3 py-2" style="font-size: 20px;"><a href="{{route('orders.index')}}" class="text-white text-decoration-none"> {{$pendingorder }}</a></span>
                @else
                <span class="badge bg-danger px-3 py-2" style="font-size: 20px;">X</span>
                @endif
                @endif
            </div>
        </div>
    </div>
    <div class="col-md-2">
        <div class="card">
            <div class="card-header">
                <h4>Shipped Order</h4>
                @if(Auth::check())
                @if($shippedorder > 0 )
                <span class="badge bg-secondary px-3 py-2" style="font-size: 20px;"><a href="{{route('orders.index')}}" class="text-white text-decoration-none"> {{$shippedorder }}</a></span>
                @else
                <span class="badge bg-danger px-3 py-2" style="font-size: 20px;">X</span>
                @endif
                @endif
             
            </div>
        </div>
    </div>
    <div class="col-md-2">
        <div class="card">
            <div class="card-header">
                <h4>Canceld Order</h4>
                @if(Auth::check())
                @if($canceledorder > 0)
                <span class="badge bg-secondary px-3 py-2" style="font-size: 20px;"><a href="{{route('orders.index')}}" class="text-white text-decoration-none"> {{$canceledorder }}</a></span>
                @else
                <span class="badge bg-danger px-3 py-2" style="font-size: 20px;">X</span>
                @endif
                @endif
            </div>
        </div>
    </div>
    <div></div>&nbsp;&nbsp;  &nbsp;&nbsp;  &nbsp;&nbsp;&nbsp; <div></div>&nbsp;&nbsp;  &nbsp;&nbsp;  &nbsp;&nbsp;&nbsp;


    <div class="col-md-2">
        <div class="card">
            <div class="card-header">
                <h4>Active Category</h4>
                @if(Auth::check())
                @if($activecategory > 0)
                  <span class="badge bg-secondary px-3 py-2" style="font-size: 20px;">
                      <a href="{{route('categories.index')}}" class="text-white text-decoration-none">{{$activecategory}}</a>
                          </span>
                     
                @else
                <span class="badge bg-danger px-3 py-2" style="font-size: 20px;">X</span>
                @endif
                @endif
               
            </div>
        </div>
    </div>

    <div class="col-md-2">
        <div class="card">
            <div class="card-header">
                <h4>inActive Category</h4>
                @if(Auth::check())
                  @if($inactivecategory > 0 )
                  <span class="badge bg-secondary px-3 py-2" style="font-size: 20px;"><a href="{{route('categories.index')}}" class="text-white text-decoration-none"> {{$inactivecategory }}</a></span>
                  @else
                  <span class="badge bg-danger px-3 py-2" style="font-size: 20px;">X</span>
                  @endif
                @endif
            </div>
        </div>
    </div>
    
    <div class="col-md-2">
        <div class="card">
            <div class="card-header">
                <h4>Active Product</h4>
                @if(Auth::check())
                @if($activeproduct > 0)
                <span class="badge bg-secondary px-3 py-2" style="font-size: 20px;"><a href="{{route('products.index')}}" class="text-white text-decoration-none"> {{$activeproduct }}</a></span>
                @else
                <span class="badge bg-danger px-3 py-2" style="font-size: 20px;">X</span>
                @endif
              @endif
            </div>
        </div>
    </div>

    <div class="col-md-2">
        <div class="card">
            <div class="card-header">
                <h4>inActive Product</h4>
                @if(Auth::check())
                @if($inactiveproduct > 0)
                <span class="badge bg-secondary px-3 py-2" style="font-size: 20px;"><a href="{{route('products.index')}}" class="text-white text-decoration-none"> {{$inactiveproduct }}</a></span>
                @else
                <span class="badge bg-danger px-3 py-2" style="font-size: 20px;">X</span>
                @endif
                @endif
            </div>
        </div>
    </div>

    <div class="col-md-2">
        <div class="card">
            <div class="card-header">
                <h4>Trending Product</h4>
                @if(Auth::check())
                @if($trandingproduct > 0)
                <span class="badge bg-secondary px-3 py-2" style="font-size: 20px;"><a href="{{route('products.index')}}" class="text-white text-decoration-none"> {{$trandingproduct }}</a></span>
                @else
                <span class="badge bg-danger px-3 py-2" style="font-size: 20px;">X</span>
                @endif
                @endif
            </div>
        </div>
    </div>
    
    @endif
    @if(Auth::user()->role_as == '0')
    &nbsp;  &nbsp;  <div class="col-md-10">
        <div class="card">
            <div class="card-header">
              <h3>Working Tasks</h3>
              <div class="col-md mb-4 mb-md-2">
                <small class="text-light fw-medium">Basic Accordion</small>
                <div class="accordion mt-3" id="accordionExample">
                  <div class="card accordion-item">
                    <h2 class="accordion-header" id="headingOne">
                      <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#accordionOne" aria-expanded="false" aria-controls="accordionOne">
                        Category Count
                      </button>
                    </h2>
            
                    <div id="accordionOne" class="accordion-collapse collapse" data-bs-parent="#accordionExample" style="">
                      <div class="accordion-body">
                        @if(Auth::check())
                        @if($category > 0 )
                        <span class="badge bg-secondary px-3 py-2" style="font-size: 20px;"><a href="{{route('categories.index')}}" class="text-white text-decoration-none"> {{$category }}</a></span>
                        @else
                        <span class="badge bg-danger px-3 py-2" style="font-size: 20px;">X</span>
                        @endif
                        @endif
                       
                      </div>
                    </div>
                  </div>
                  <div class="card accordion-item">
                    <h2 class="accordion-header" id="headingTwo">
                      <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#accordionTwo" aria-expanded="false" aria-controls="accordionTwo">
                        Product Count
                      </button>
                    </h2>
                    <div id="accordionTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                      <div class="accordion-body">
                        @if(Auth::check())
                        @if($products > 0)
                        <span class="badge bg-secondary px-3 py-2" style="font-size: 20px;"><a href="{{route('products.index')}}" class="text-white text-decoration-none"> {{$products }}</a></span>
                        @else
                        <span class="badge bg-danger px-3 py-2" style="font-size: 20px;">X</span>
                        @endif
                        @endif
                       
                      </div>
                    </div>
                  </div>
                  <div class="card accordion-item">
                    <h2 class="accordion-header" id="headingThree">
                      <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#accordionThree" aria-expanded="false" aria-controls="accordionThree">
                        Order Count
                      </button>
                    </h2>
                    <div id="accordionThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                      <div class="accordion-body">
                        @if(Auth::check())
                        @if($orderItem > 0)
                        <span class="badge bg-secondary px-3 py-2" style="font-size: 20px;"><a href="{{route('orders.index')}}" class="text-white text-decoration-none"> {{$orderItem }}</a></span>
                        @else
                        <span class="badge bg-danger px-3 py-2" style="font-size: 20px;">X</span>
                        @endif
                        @endif
                        
                      </div>
                    </div>
                  </div>
                  <div class="card accordion-item">
                    <h2 class="accordion-header" id="headingFive">
                      <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#accordionsix" aria-expanded="false" aria-controls="accordionsix">
                        Wishlist Count
                      </button>
                    </h2>
                    <div id="accordionsix" class="accordion-collapse collapse" aria-labelledby="headingFive" data-bs-parent="#accordionExample">
                      <div class="accordion-body">
                        @if(Auth::check())
                        @if($wishlist > 0)
                        <span class="badge bg-secondary px-3 py-2" style="font-size: 20px;"><a href="{{route('wishlists.index')}}" class="text-white text-decoration-none"> {{$wishlist }}</a></span>
                        @else
                        <span class="badge bg-danger px-3 py-2" style="font-size: 20px;">X</span>
                        @endif
                        @endif
                      </div>
                    </div>
                  </div>
                  <div class="card accordion-item">
                    <h2 class="accordion-header" id="headingSix">
                      <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#accordionseven" aria-expanded="false" aria-controls="accordionseven">
                        Cart Count
                      </button>
                    </h2>
                    <div id="accordionseven" class="accordion-collapse collapse" aria-labelledby="headingSix" data-bs-parent="#accordionExample">
                      <div class="accordion-body">
                        @if(Auth::check())
                        @if($wishlist > 0)
                        <span class="badge bg-secondary px-3 py-2" style="font-size: 20px;"><a href="{{route('carts.index')}}" class="text-white text-decoration-none"> {{$wishlist }}</a></span>
                        @else
                        <span class="badge bg-danger px-3 py-2" style="font-size: 20px;">X</span>
                        @endif
                        @endif
                      </div>
                    </div>
                  </div>
                  <div class="card accordion-item">
                    <h2 class="accordion-header" id="headingSeven">
                      <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#accordioneight" aria-expanded="false" aria-controls="accordioneight">
                        Delivered Order
                      </button>
                    </h2>
                    <div id="accordioneight" class="accordion-collapse collapse" aria-labelledby="headingSeven" data-bs-parent="#accordionExample">
                      <div class="accordion-body">
                        @if(Auth::check())
                        @if($deliveredorderemp > 0)
                        <span class="badge bg-secondary px-3 py-2" style="font-size: 20px;"><a href="{{route('orders.index')}}" class="text-white text-decoration-none"> {{$deliveredorderemp }}</a></span>
                        @else
                        <span class="badge bg-danger px-3 py-2" style="font-size: 20px;">X</span>
                        @endif
                        @endif
                      </div>
                    </div>
                  </div>
                  <div class="card accordion-item">
                    <h2 class="accordion-header" id="headingEight">
                      <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#accordionnine" aria-expanded="false" aria-controls="accordionnine">
                        Pending Order
                      </button>
                    </h2>
                    <div id="accordionnine" class="accordion-collapse collapse" aria-labelledby="headingEight" data-bs-parent="#accordionExample">
                      <div class="accordion-body">
                        @if(Auth::check())
                        @if($pendingorderemp >0)
                        <span class="badge bg-secondary px-3 py-2" style="font-size: 20px;"><a href="{{route('orders.index')}}" class="text-white text-decoration-none"> {{$pendingorderemp }}</a></span>
                        @else
                        <span class="badge bg-danger px-3 py-2" style="font-size: 20px;">X</span>
                        @endif
                        @endif
                      </div>
                    </div>
                  </div>
                  <div class="card accordion-item">
                    <h2 class="accordion-header" id="headingNine">
                      <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#accordionten" aria-expanded="false" aria-controls="accordionten">
                        Shipped Order
                      </button>
                    </h2>
                    <div id="accordionten" class="accordion-collapse collapse" aria-labelledby="headingNine" data-bs-parent="#accordionExample">
                      <div class="accordion-body">
                        @if(Auth::check())
                        @if($shippedorderemp)
                        <span class="badge bg-secondary px-3 py-2" style="font-size: 20px;"><a href="{{route('orders.index')}}" class="text-white text-decoration-none"> {{$shippedorderemp }}</a></span>
                        @else
                        <span class="badge bg-danger px-3 py-2" style="font-size: 20px;">X</span>
                        @endif
                        @endif
                      </div>
                    </div>
                  </div>
                  <div class="card accordion-item">
                    <h2 class="accordion-header" id="headingTen">
                      <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#accordioneleven" aria-expanded="false" aria-controls="accordioneleven">
                        Canceled Order
                      </button>
                    </h2>
                    <div id="accordioneleven" class="accordion-collapse collapse" aria-labelledby="headingTen" data-bs-parent="#accordionExample">
                      <div class="accordion-body">
                        @if(Auth::check())
                        @if($canceledorderemp > 0)
                        <span class="badge bg-secondary px-3 py-2" style="font-size: 20px;"><a href="{{route('orders.index')}}" class="text-white text-decoration-none"> {{$canceledorderemp }}</a></span>
                        @else
                        <span class="badge bg-danger px-3 py-2" style="font-size: 20px;">X</span>
                        @endif
                        @endif
                      </div>
                    </div>
                  </div>

                </div>
              </div>
            </div>
        </div>
    </div>    
    @endif
   
</div>
@endsection
