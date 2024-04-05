@extends('layouts.app')

@section('title', "Ecommerce App| $categories->meta_title")

@if(Auth::check())
@section('content')
    <div class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-9">
                    <div class="category-heading ">
                        <h4>{{ $categories->name }}</h4>
                    </div>

                    @forelse($products as $prod)
                        <div class="card card-shadow mt-4">
                            <div class="card-body">
                               
                                <h6>
                                    @php

                                    $productImage = $prod->productImages()->first();
        
                                    @endphp
                                    <a href="{{ url('ProductSlug/'.$categories->slug.'/'.$prod->slug)}}" class="product-img">
                                        @if (!empty($productImage->image))
                                            <img class="card-img-top" src="{{ asset($productImage->image) }}"
                                                style="width: 20%;">
                                        @else
                                            <img class="card-img-top"
                                                src="{{ asset('admin-assets/img/default-150x150.png') }}" width="50">
                                        @endif
                                    </a>
                                    <a href="{{ url('ProductSlug/'.$categories->slug.'/'.$prod->slug)}}"
                                    style="text-decoration: none;">
                                    <h4 class="text-black"><span >Product:</span>&nbsp;{{ $prod->name }}</h4>
                                    <h4 class="text-black"><span>Price:</span>&nbsp;{{ $prod->selling_price }}
                                        @if ($prod->orignal_price > 0)
                                        <span class="h6 text-underline"><del>{{ $prod->orignal_price }}</del></span>
                                        @endif
                                    </h4>


                                </a>
                                   
                                 
                                </h6>
                                

                            </div>
                        </div>
                        <div class="your-paginate mt-4">
                            {{ $products->links() }}
                        </div>
                    @empty
                        <div class="card card-shadow mt-4">
                            <div class="card-body">
                                <h2>No Products Available</h2>
                            </div>
                        </div>
                        
                    @endforelse
                   

                </div>
                <div class="col-md-3">
                    <div class="kp-border p-2  text-black">

                        <h4>Products Area</h4>
                    </div>
                    <div class="card mt-3">
                        <div class="card-header">
                            <h4>Products</h4>
                          </div>
                        <div class="card-body">
                            @foreach($rel_product as $rel_pro)
                            <a href="{{route('view.index', ['slug' => $rel_pro->category->slug, 'p_slug' => $rel_pro->slug]) }}" style="text-decoration: none;"><h4>{{$rel_pro->name}}</h4></a>
                             @endforeach
                        </div>
                    </div>
                    
                    

                </div>
                
            </div>
            
        </div>
    </div>
   
@endsection

@endif






