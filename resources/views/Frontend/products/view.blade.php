@extends('layouts.app')
@section('title' ,"Ecommerce App| Product")
@section('content')
@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
@if (session('warning'))
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        {{ session('warning') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
@if (session('error'))
    <div class="alert alert-error alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
@if(Auth::check())
<section class="section-3 pt-3">
    <div class="container"><br/>
        <div class="section-title">
        <h2 class="badge bg-primary px-2 py-2 " style="font-size: 20px;">View Product Details</h2>
        <a href="{{url()->previous()}}" class="btn btn-primary float-end">Back</a>
        </div>
       
        <div class="row pb-3">
      
            @if ($products->isNotEmpty())
                @foreach ($products as $product)
                <div>
                    
                    <ol style="font-weight: bold;">
                      <li><h6 class="text-bold" style="font-weight:bold;font-size:17px;">{{ strtoupper($product->category->name).' / '. strtoupper($product->name)}}</h6></li>
                    </ol>
                  </div>
                    @php

                        $productImage = $product->productImages()->first();

                    @endphp

                    <div class="col-md-12">
                        <div class="card product-card">
                            <div class="product-image position-relative">
                                <a href="" class="product-img" style="margin-left: 25%">
                                    @if (!empty($productImage->image))
                                        <img class="card-img-top me-4 border" src="{{ asset($productImage->image) }}"
                                           style="width:40%;">
                                    @else
                                        <img class="card-img-top"
                                            src="{{ asset('admin-assets/img/default-150x150.png') }}" width="50">
                                    @endif
                                </a>
                               <br/><br/>
                                    <div class="_1AuMiq P9aMAP _2_B7hD" style="display: flex;">
                                
                                        @php
                                        $productImages = $product->productImages;
                                        @endphp
                                
                                        <div class="_2E1FGS _2_B7hD" style="display: block; align-items: center;">
                                
                                            @if ($productImages->isNotEmpty())
                                                <div class="image-block d-flex flex-wrap justify-content-start" style="margin-left: 25vh;">
                                                    @foreach ($productImages as $image)
                                                        <img class="card-img-top me-4 border" src="{{ asset($image->image) }}" style="max-width: 70px; height: auto;">
                                                    @endforeach
                                                </div>
                                            @else
                                                <div class="badge-block" style="margin-right: 25px;">
                                                    <span class="badge bg-danger">No Image Available</span>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                            </div><br/>
                            <a class="h2 link text-decoration-none" href="" style="margin-left: 30%;"><span class="text-black">Name: {{ $product->name }}</span></a>
                            
                                <div class="price mt-2" style="margin-left: 30%;">
                                    <span class="h2 font-weight-bold text-success">Price:&nbsp;<strong>{{ $product->selling_price }}</strong></span>
                                    @if ($product->orignal_price > 0)
                                        <span class="h6 text-muted"><del>{{ $product->orignal_price }}</del></span>
                                    @endif
                                </div>
                                <h2><span class="mt-2" style="margin-left: 30%;color: #333;">Quantity:&nbsp;</span>{{$product->quantity}}</h2>
                                
                                <form action="{{ url('addcart', $product->id) }}" method="post" class="d-flex justify-content-center">
                                    @csrf
                                    @method('POST')
                                    <button type="submit" class="btn btn-dark me-3"><i class="fa fa-shopping-cart"></i>Add To Cart</button>
                                    @php
                                    $existingCart = \App\Models\Cart::where('product_id', $product->id)->first();
                                    @endphp
                                    @if ($existingCart)
                                    <a href="{{ url('cartPage') }}" class="btn bg-warning py-2 text-white" style="width:12%;font-size:15px;"><i class="fa fa-shopping-cart"></i>Go To Cart</a>
                                    @endif
                                </form> 
                                <form action="{{ url('addtowishlist', $product->id) }}" method="post" style="position: absolute; top: -13px; right: 5px;">
                                    @csrf
                                    @method('POST')
                                
                                    <button type="submit" style="padding: 10px; text-decoration: none; background: none; border: none;">
                                        <span style="display: inline-block; padding: 9px; border-radius: 25px;">
                                            <i class="fa fa-heart" style="font-size: 30px; color: #e1dbdb;"></i>
                                        </span>
                                        
                                    </button>
                                </form>
                        </div>  
                        <div class="col-md-12 mt-5">
                            <div class="bg-light">
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active" id="description-tab" data-bs-toggle="tab" data-bs-target="#description" type="button" role="tab" aria-controls="description" aria-selected="true">Description</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="shipping-tab" data-bs-toggle="tab" data-bs-target="#shipping" type="button" role="tab" aria-controls="shipping" aria-selected="false">Shipping & Returns</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="reviews-tab" data-bs-toggle="tab" data-bs-target="#reviews" type="button" role="tab" aria-controls="reviews" aria-selected="false">Reviews</button>
                                    </li>
                                </ul>
                                <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane fade show active" id="description" role="tabpanel" aria-labelledby="description-tab">
                                        <div class="product-description">
                                            <h3>Description:</h3>
                                            <div class="description-content">
                                                {!! $product->description !!}
                                            </div>
                                        </div>
                                        <div class="product-price">
                                            <h3>Original Price:</h3>
                                            <div class="price-content">
                                                {{$product->orignal_price}}
                                            </div>
                                        </div>
                                        <div class="product-price">
                                            <h3>Selling Price:</h3>
                                            <div class="price-content">
                                                {{$product->selling_price}}
                                            </div>
                                        </div>
                                       
                                        <style>
                                            /* CSS for product description and original price */
                                        .product-description,
                                        .product-price {
                                            background-color: #f9f9f9;
                                            border: 1px solid #ddd;
                                            border-radius: 5px;
                                            padding: 20px;
                                            margin-bottom: 20px;
                                        }

                                        .product-description h3,
                                        .product-price h3 {
                                            color: #333;
                                            margin-top: 0;
                                        }

                                        .description-content,
                                        .price-content {
                                            color: #666;
                                            font-size: 16px;
                                        }

                                        </style>
                                    </div>
                                    <div class="tab-pane fade" id="shipping" role="tabpanel"     aria-labelledby="shipping-tab">
                                        <div class="Order">
                                            <h3>Orders  Delivery:</h3>
                                            <div class="shipping-content">
                                                @if(!empty($orderItem))
                                                <span class="badge bg-success" style="font-size: 20px; display: block; margin-bottom: 10px;">We can Deliver Product Within 10 To 15 Days</span>
                                                <br/><br/>
                                                <span class="badge bg-warning" style="font-size: 20px;display: block;">You Can Return The Product Within 30 Days</span>
                                            @endif
                                            </div>
                                        </div>
                                     
                                    </div>
                                    <div class="tab-pane fade" id="reviews" role="tabpanel" aria-labelledby="reviews-tab">
                                        <div class="comment-area mt-4">

                                            @if (session('success'))
                                                <h6 class="alert alert-warning mb-3">{{session('success')}}</h6>
                                            @endif
                                            <div class="card card-body">
                                               <h6 class="card-title">Leave Comment:</h6>
                                               <form action="{{url('comments')}}" method="post" enctype="multipart/form-data">
                                                @csrf
                                                @method('POST')
                                                @if($errors->any())
                                                <div class="alert alert-danger">
                                                    @foreach($errors->all() as $error)
                                                        <div>{{$error}}</div>
                                                    @endforeach
                                                </div>
                                                @endif
                                                <input type="hidden" name="p_slug" value="{{$product->slug}}">
                                                <input type="file" name="image" name="image" placeholder="Enter Your Item Image" class="form-control @error('image') is-invalid @enderror" >
                                                <br/>
                                                 <textarea name="comment" id="comment" class="form-control @error('comment') is-invalid @enderror" rows="3"  ></textarea> 
                                                <button type="submit" class="btn btn-primary mt-3">Submit</button>
                                               </form>
                                            </div>
                                            @if(Auth::check())
                                            @foreach ($products as $product)
                                            @if ($product->comments()->count() > 0)
                                                @foreach ($product->comments as $comment)
                                                    <div class="comment-container card card-body shadow-sm mt-3">
                                                        <div class="detail-area">
                                                         
                                                            <image src="{{asset($comment->image)}}" style="width:90px;border-radius:30px;"></image><br/>
                                                          
                                                            <p class="user-comment mb-0">
                                                                <span >
                                                                    @if($comment->user)
                                                                        <p style="font-weight: bold;">Name: {{$comment->user->name}}&nbsp;
                                                                            <span class="badge bg-dark">
                                                                                {{-- {{ $comment->user->role_as == '1' ? 'SuperAdmin' : (auth()->user()->role_as == '0' ? 'Employee' : (auth()->user()->role_as == '2' ? 'Customer')) }} --}}
                                                                                {{ $comment->user->role_as == '1' ? 'SuperAdmin' : ($comment->user->role_as == '0' ? 'Employee' : ($comment->user->role_as == '2' ? 'Customer' : 'Unknown')) }}

                                                                            </span>
                                                                        </p>
                                                                    @endif
                                                                </span>
                                                            </p>
                                                            
                                                            <span class="text-primary" style="font-weight: bold;">Commented On:{{$comment->created_at->format('d-m-Y')}}</span>
                                                            <p class="user-comment mb-0"  style="font-weight: bold;">
                                                                Comment:{{ $comment->comment}}
                                                            </p>
                                                            <a href="{{url('edit',$comment->id)}}"><i class="fas fa-edit" style="color: black"></i></a>
                                                            
                                                            <form action="{{url('delete-comment',$comment->id)}}" method="POST" style="margin-left: 20px;margin-top:-26px;">
                                                            @csrf
                                                            @method('post')
                                                            <button type="submit" style="background-color: white;border:none"><i class="fa fa-trash" style="color: black;"></i></button>
                                                            
                                                            </form>
                                                        </div>
                                                    </div>
                                                    
                                                @endforeach
                                            @else
                                                <br/>
                                                <h6 class="card card-body">No Comments Found</h6>
                                            @endif
                                         @endforeach
                                         @endif
                                           
                                        </div>
                                    </div>
                                </div>     
                            </div>
                        </div>   
                    </div>
             
                  
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</section>
@endif
@if(!Auth::check())
    <a href="{{url('/Front')}}" class="btn btn-danger">Go Back!!</a>
@endif
@endsection