@extends('layouts.app')
@section('title','Ecommerce App| Wishlist Page')
@section('content')
@if (session('success'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('success') }}
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
           
   
        <div class="section-title">
            <h2>My Wishlist</h2>
        
            <span class="badge bg-secondary" style="font-size:17px;">
                @php
                $wishQuantity = App\Models\Wishlist::where('user_id', Auth::id())->get();
                @endphp
                {{count($wishQuantity)}} &nbsp;items
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
                                </div>
                            </div>
                            <form action="{{ url('addcart', $wishlist->products->id) }}" method="post">
                                @csrf
                                @method('POST')
                                <button type="submit" style="margin-left:30%;" class="btn btn-dark" ><i class="fa fa-shopping-cart"></i>Add To Cart</button>
                                @php
                                $existingCart = \App\Models\Cart::where('product_id', $wishlist->products->id)->first();
                                @endphp
                                @if ($existingCart)
                                <a href="{{ url('cartPage') }}" class="btn bg-warning py-1 text-white" style="width:127px;font-size:15px;margin-left:30%;"><i class="fa fa-shopping-cart"></i>Go To Cart</a>
                                @endif
                            </form>
                            <form action="{{ url('removeWishlist/'.$wishlist->id) }}" method="post" style="position: absolute; top: -5px; right: 5px;">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="id" value="{{ $wishlist->id }}">
                                <button type="submit"  style="padding: 6px; text-decoration: none; background: none; border: none;"><span style="display: inline-block; padding: 6px; border-radius: 70%; background-color: #ffffff;">
                                    <i class="fas fa-times" style="font-size: 20px; color: gray;"></i>
                                </span>
                                
                                </button>
                            </form>
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