@extends('layouts.master')
@section('title','Ecommerce App| Wishlist Page')
@section('content')
@if (session('cart_delete'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('cart_delete') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
@if (session('message'))
<div class="alert alert-success alert-dismissible fade show">{{session('message')}}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
<section class="section-4 pt-5">
    <div class="container">
        
        <style>
            .wishlist-item {
                margin-bottom: 20px;
                padding: 15px;
                border: 1px solid #ddd;
                border-radius: 5px;
            }
        
            .wishlist-title {
                font-size: 24px;
                font-weight: bold;
                color: #333;
                margin-bottom: 10px;
            }
        
            .section-title {
                margin-top: 30px;
                margin-bottom: 20px;
            }
        </style>
         <div class="card">
            <h2 style="text-align: center">Search For Wishlisted Products</h2>
        </div><br/>
        
        <form action="{{url('admin/searchwishlist')}}" method="GET"class="ms-auto">
            <div class="input-group">
                <input class="form-control" type="text" name="search" placeholder="Search for..." value="{{isset($search) ? $search : ''}} "aria-describedby="btnNavbarSearch" />
                <button class="btn btn-primary" id="btnNavbarSearch" type="submit"><i class="fas fa-search"></i></button>
            </div>
        </form>
   
        <div class="section-title">
            <h2>My Wishlist</h2>
        
            <span class="badge bg-secondary" style="font-size:17px;">
                @if(Auth::user()->role_as == 1)
                @php
                $wishQuantity = App\Models\Wishlist::get();
                @endphp
                {{count($wishQuantity)}} &nbsp;items
                @else
                @php
                $wishQuantity = App\Models\Wishlist::where('user_id', Auth::id())->get();
                @endphp
                {{count($wishQuantity)}} &nbsp;items
                @endif
            </span>
            <span>
             
             
         
           
            </span>
        </div><br/>
        <div class="row pb-3">
            @if ($wishlists->isNotEmpty())
                
                @foreach ($wishlists as $wishlist)
                

                    <div class="col-md-3">
                        <div class="card product-card">
                            <div class="product-image position-relative">
                                <a href="" class="product-img">
                                   
                                    @php
                                    $productImages = $wishlist->products->productImages;
                                @endphp

                                @if ($productImages->isNotEmpty())
                                    {{-- Display only the first image --}}
                                    <img class="card-img-top" src="{{ asset($productImages->first()->image) }}" style="width: 100%;">
                                @else
                                    <span>No Image Available</span>
                                @endif

                                    
                                </a>
                                

                               
                            </div>
                              
                            <div class="card-body text-center mt-3">
                                <a class="h6 link text-decoration-none" href="" style="font-size:20px;">{{ $wishlist->products->name }}</a>
                                <div class="price mt-2">
                                    <span class="h5"><strong>₹{{ $wishlist->products->selling_price }}</strong></span>
                                </div><br/>
                                <label class="form-label" for="role_as" style="font-size: 20px;">Role:</label>
                                @if(Auth::user()->role_as == 1 || Auth::user()->role_as =='0')
                                @if($wishlist->user)
                                    @if($wishlist->user->role_as == 1)
                                        <span class="badge bg-success" style="font-size: 17px;"><i class="fas fa-crown"></i> SuperAdmin</span>
                                    @elseif($wishlist->user->role_as == 0)
                                        <span class="badge bg-primary" style="font-size: 17px;"><i class="fas fa-user-tie"></i> Employee</span>
                                    @else
                                        <span class="badge bg-danger" style="font-size: 17px;"><i class="fas fa-user"></i> Customer</span>
                                    @endif
                                @endif
                                @endif
                            </div>
                            
                            <form action="{{ url('addcart', $wishlist->products->id) }}" method="post">
                                @csrf
                                @method('POST')
                                <button type="submit" style="margin-left:30%;" class="btn btn-dark" ><i class="fa fa-shopping-cart"></i>Add To Cart</button>
                                @php
                                    $existingCart = \App\Models\Cart::where('user_id',Auth::user()->id)->where('product_id' , $wishlist->product_id)->first();
                                    @endphp
                                    @if ($existingCart)
                                    <a href="{{ route('carts.index') }}" class="btn bg-warning py-1 text-white" style="width:127px;font-size:15px;margin-left:30%;"><i class="fa fa-shopping-cart"></i>Go To Cart</a>
                                    @endif
                            </form>
                            @if(Auth::user()->role_as == '1')
                            <form action="{{ url('removeWishlist/'.$wishlist->id) }}" method="post" style="position: absolute; top: -5px; right: 5px;">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="id" value="{{ $wishlist->id }}">
                                <button type="submit" style="padding: 6px; text-decoration: none; background: none; border: none;"><span style="display: inline-block; padding: 6px; border-radius: 70%; background-color: #ffffff;">
                                    <i class="fas fa-times" style="font-size: 20px; color: gray;"></i>
                                </span>
                                
                                </button>
                            </form>
                            @endif
                        </div>
                    </div>
                @endforeach
            @else
                <span class="badge bg-danger" style="font-size:20px;width:460px;margin-top:-10px;">No Product Found in Wishlist</span>
            
            @endif
        </div>
    </div>
</section>
@endsection