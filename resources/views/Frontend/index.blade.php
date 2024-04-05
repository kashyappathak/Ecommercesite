@extends('layouts.app')
@section('title', isset($setting) ? $setting->meta_title : 'Ecommerce App')
@section('content')
@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
    @if(Auth::check())
    <section class="section-3">
        <div class="container">
            <div class="section-title">
                <h2>Categories</h2>
            </div>
       
       
        <select id="categoryFilter" class="form-select mb-3" style="width: 150px;">
            <option value="all">All Categories</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>

            <div class="owl-carousel category-carousel owl-theme">
                @foreach ($categories as $category)
                
                    <div class="item" data-category-id="{{$category->id}}">
                        
                        <a href="{{url('CategorySlug/' .$category->slug)}}" class="text-decoration-none">
                            <div class="card">
                                @if ($category->image)
                                    <img src="{{ asset($category->image) }}" alt="Category Image"
                                    class="card-img-top">
                                @else
                                    @php
                                        $initials = strtoupper(substr($category->name, 0, 1));
                                        $initials1 = strtoupper(substr($category->slug, 0, 1));
                                    @endphp
                                    <div
                                    class="category-placeholder d-flex justify-content-center align-items-center">
                                        {{ $initials . $initials1 }}
                                    </div>
                                @endif
                                <div class="card-body text-center">
                                    <h5 class="text-dark"><span class="badge bg-dark">{{ $category->name }}</span></h5>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
   
    <section class="section-2 pt-5">
        <div class="container">
            <div class="section-title">
                <h2>Brands</h2>
            </div>
            <div class="row pb-3">
              
                <select id="brandFilter" class="form-select mb-3" style="width: 150px;">
                    <option value="all">All Brands</option>
                    @foreach ($brands as $brand)
                        <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                    @endforeach
                </select>   
                <div class="card-body" style="display: flex;">
                    @foreach($brands as $brand)
                        <div class="item1" data-brand-id = {{$brand->id}}>
                            <a class="h6 link text-decoration-none mr-3 mb-3 " style="font-size: 30px;" href="">&nbsp;&nbsp;<span class="badge bg-secondary">{{ $brand->name }}</span></a>
                        </div>
                       
                    @endforeach
                </div>
                


            </div>
        </div>
    </section>
    

    <br/>
    <section class="section-4 pt-5">
        <div class="container">
            <div class="section-title">
                <h2>Featured Products</h2>
            </div>
            <div style="display: flex; align-items: center;">  
                <select id="productFilter" class="form-select mb-3" style="width: 150px;">
                    <option value="all">All Products</option>
                    @foreach ($products as $product)
                        <option value="{{ $product->id }}">{{ $product->name }}</option>
                    @endforeach
                </select> &nbsp;&nbsp;
                <select id="priceFilter" class="form-select mb-3" style="width: 180px;">
                    <option value="0">All Products Prices</option>
                    @foreach ($uniqueSellingPrices as $price)
                        <option value="{{ $price }}">{{ $price }}</option>
                    @endforeach
                </select>
            </div>
            
           
            <div class="row pb-3 ">
                @if ($products->isNotEmpty())
                    @foreach ($products as $product)
                        @php

                            $productImage = $product->productImages()->first();

                        @endphp

                        <div class="item3 col-md-3" data-product-id = {{$product->id}}  data-selling-price = {{$product->selling_price}}>
                            <div class="card product-card">
                                <div class="product-image position-relative">
                                    <a href="{{ route('view.index', ['slug' => $product->category->slug, 'p_slug' => $product->slug]) }}" class="product-img">
                                        @if (!empty($productImage->image))
                                            <img class="card-img-top" src="{{ asset($productImage->image) }}"
                                                width="50">
                                                <form action="{{ url('addtowishlist', $product->id) }}" method="post" style="position: absolute; top: -13px; right: 1px;left:5px">
                                                    @csrf
                                                    @method('POST')
                                                
                                                    <button type="submit" style="margin-left: 80%; padding: 10px; text-decoration: none; background: none; border: none;">
                                                        <span style="display: inline-block;; padding: 9px; border-radius: 25px;">
                                                            <i class="fa fa-heart" style="font-size: 25px; color: #e1dbdb;"></i>
                                                        </span>
                                                        
                                                    </button>
                                                </form>
                                        @else
                                            <img class="card-img-top"
                                                src="{{ asset('admin-assets/img/default-150x150.png') }}" width="50">
                                        @endif
                                    </a>
                            

                                  
                                </div>
                                <div class="card-body text-center mt-3">
                                    <a class="h6 link text-decoration-none" href="" style="font-size: 20px;">{{ $product->name }}</a>
                                    <div class="price mt-2">
                                        <span class="h5"><strong>{{ $product->selling_price }}</strong></span>
                                        @if ($product->orignal_price > 0)
                                            <span class="h6 text-underline"><del>{{ $product->orignal_price }}</del></span>
                                        @endif
                                    </div>
                                </div>
                           
                                <form action="{{ url('addcart', $product->id) }}" method="post">
                                    @csrf
                                    @method('POST')
                                    <button type="submit" style="margin-left:30%;" class="btn btn-dark" ><i class="fa fa-shopping-cart"></i>Add To Cart</button>

                                    @php
                                    $existingCart = \App\Models\Cart::where('user_id',Auth::user()->id)->where('product_id', $product->id)->first();
                                    @endphp
                                    @if ($existingCart)
                                    <a href="{{ url('cartPage') }}" class="btn bg-warning py-1 text-white" style="width:127px;font-size:15px;margin-left:30%;"><i class="fa fa-shopping-cart"></i>Go To Cart</a>
                                    @endif
                                </form>
                                 
                            </div>
                        </div>
                    @endforeach
                @endif


            </div>
        </div>
    </section>


    <section class="section-4 pt-5">
        <div class="container">
            <div class="section-title">
                <h2>Latest Produsts</h2>
            </div>
            <div class="row pb-3">
                @if ($latestProducts->isNotEmpty())
                    @foreach ($latestProducts as $product)
                        @php

                            $productImage = $product->productImages()->first();

                        @endphp

                        <div class="col-md-3">
                            <div class="card product-card">
                                <div class="product-image position-relative">
                                    <a href="{{ route('view.index', ['slug' => $product->category->slug, 'p_slug' => $product->slug]) }}" class="product-img">
                                       
                                        @if (!empty($productImage->image))
                                            <img class="card-img-top" src="{{ asset($productImage->image) }}" >
                                            <form action="{{ url('addtowishlist', $product->id) }}" method="post" style="position: absolute; top: -13px; right: 1px;left:5px">
                                                @csrf
                                                @method('POST')
                                            
                                                <button type="submit" style="margin-left: 80%; padding: 10px; text-decoration: none; background: none; border: none;">
                                                    <span style="display: inline-block;; padding: 9px; border-radius: 25px;">
                                                        <i class="fa fa-heart" style="font-size: 25px; color: #e1dbdb;"></i>
                                                    </span>
                                                    
                                                </button>
                                            </form>
                                        @else
                                            <img class="card-img-top"
                                                src="{{ asset('admin-assets/img/default-150x150.png') }}">
                                        @endif

                                        
                                    </a>
                                    

                                   
                                </div>
                                <div class="card-body text-center mt-3">
                                    <a class="h6 link text-decoration-none" style="font-size:20px;">{{ $product->name }}</a>
                                    <div class="price mt-2">
                                        <span class="h5"><strong>{{ $product->selling_price }}</strong></span>
                                        @if ($product->orignal_price > 0)
                                            <span class="h6 text-underline"><del>{{ $product->orignal_price }}</del></span>
                                        @endif
                                    </div>
                                </div>
                                <form action="{{ url('addcart', $product->id) }}" method="post">
                                    @csrf
                                    @method('POST')
                                    <button type="submit" style="margin-left:30%;" class="btn btn-dark" ><i class="fa fa-shopping-cart"></i>Add To Cart</button>
                                    @php
                                    $existingCart = \App\Models\Cart::where('user_id',Auth::user()->id)->where('product_id', $product->id)->first();
                                    @endphp
                                    @if ($existingCart)
                                    <a href="{{ url('cartPage') }}" class="btn bg-warning py-1 text-white" style="width:127px;font-size:15px;margin-left:30%;"><i class="fa fa-shopping-cart"></i>Go To Cart</a>
                                    @endif
                                </form>
                                
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </section>
    @endif
    @if(!Auth::check())
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-10 text-center"> <!-- Adjust column size based on your layout -->
                <span class="badge bg-danger" style="font-size: 30px;">Please First Do Login For Continue Shopping</span>
            </div>
        </div>
    </div>
    @endif
@endsection
<!-- Add this at the end of your content section -->
@section('customJs')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            // Initial setup
            var $categoryFilter = $('#categoryFilter');
            var $categories = $('.item');

            $categoryFilter.on('change', function () {
                var selectedCategory = $(this).val();

                $categories.hide();

                if (selectedCategory === 'all') {
                    $categories.show();
                } else {
                    $categories.filter('[data-category-id="' + selectedCategory + '"]').show();
                }
            });


            var $BrandFilter = $('#brandFilter');
            var $brands = $('.item1');

            $BrandFilter.on('change', function () {
                var selectedeBrand = $(this).val();

                $brands.hide();

                if (selectedeBrand === 'all') {
                    $brands.show();
                } else {
                    $brands.filter('[data-brand-id="' + selectedeBrand + '"]').show();
                }
            });



            
            var $ProductFilter = $('#productFilter');
            var $products = $('.item3');

            $ProductFilter.on('change', function () {
                var selectedeProduct = $(this).val();

                $products.hide();

                if (selectedeProduct === 'all') {
                    $products.show();
                } else {
                    $products.filter('[data-product-id="' + selectedeProduct + '"]').show();
                }
            });


            var $PriceFilter = $('#priceFilter');
            var $products = $('.item3');

            $PriceFilter.on('change', function () {
                var selectedPrice = parseFloat($(this).val());

                $products.hide();

                if (selectedPrice === 0) {
                    $products.show(); // Show all products if "All Products" is selected
                } else {
                    $products.filter(function () {
                        return parseFloat($(this).data('selling-price')) === selectedPrice;
                    }).show();
                }
            });          
        });
    </script>
@endsection

