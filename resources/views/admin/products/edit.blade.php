@extends('layouts.master')
@section('content')
&nbsp;&nbsp;&nbsp;
@if (session('message'))
<div class="alert alert-success">{{session('message')}}</div>
@endif
@if (session('success'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
 <div class="row">
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <div class="col-md-11">
        <div class="card">
            <div class="card-header">
                <h4>Edit Products
                    <a href="{{route('products.index')}}" class="btn btn-dark float-end">Back</a>
                </h4>
            </div>
            <div class="card-body">
                <form action="{{route('products.update',$product->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    @if($errors->any())
                    <div class="alert alert-danger">
                        @foreach($errors->all() as $error)
                            <div>{{$error}}</div>
                        @endforeach
                    </div>
                    @endif  
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">Home</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="seo-tab" data-bs-toggle="tab" data-bs-target="#seo-tab-pane" type="button" role="tab" aria-controls="seo-tab-pane" aria-selected="false">SEO Tags</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="details-tab" data-bs-toggle="tab" data-bs-target="#details-tab-pane" type="button" role="tab" aria-controls="details-tab-pane" aria-selected="false">Details</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="image-tab" data-bs-toggle="tab" data-bs-target="#image-tab-pane" type="button" role="tab" aria-controls="image-tab-pane" aria-selected="false">Product Image</button>
                            </li>
                        
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
                            <div class="mb-3">
                                <label for="">Category</label>
                                <select name="category_id" class="form-control" disabled>
                                    @foreach ($category as $cat)
                                    <option value="{{$cat->id}}" {{$cat->id == $product->category_id ? 'selected' : ''}}>{{$cat->name}}</option>
                                    @endforeach
                                    
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="">Product Name:</label>
                                <input type="text" name="name" value="{{old('name',$product->name)}}" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="">Product Slug:</label>
                                <input type="text" name="slug" value="{{old('slug',$product->slug)}}" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="">Brands</label>
                         
                                <select name="brand" class="form-control">
                                    @foreach ($brand as $brands)
                                        <option value="{{$brands->id}}" {{$brands->id == $product->brand  ? 'selected' : ''}}>
                                            {{$brands->name}}
                                        </option>
                                    @endforeach
                                </select>
                                
                            </div>
                            <div class="mb-3">
                                <label for="">Product small description:</label>
                                <textarea class="form-control" name="small_description" rows="3">{{($product->small_description)}}</textarea>
                            
                            </div>
                            <div class="mb-3">
                                <label for="">Product description:</label>
                                <textarea class="form-control" name="description" rows="5">{{($product->description)}}</textarea>
                            
                            </div>
                        </div>
                        <div class="tab-pane fade" id="seo-tab-pane" role="tabpanel" aria-labelledby="seo-tab"  tabindex="0">
                            <div class="mb-3">
                                <label for="">Meta_title</label>
                                <input type="text" class="form-control" name="meta_title" value="{{old('meta_title',$product->meta_title)}}">
                            </div>
                            <div class="mb-3">
                                <label for="">Meta_description</label>
                                <input type="text" class="form-control" name="meta_description" value="{{old('meta_description',$product->meta_description)}}" >
                            </div> 
                            <div class="mb-3">
                                <label for="">Meta_keyword</label>
                                <input type="text" class="form-control" name="meta_keyword" value="{{old('meta_keyword',$product->meta_keyword)}}">
                            </div>
                        </div>
                        <div class="tab-pane fade" id="details-tab-pane" role="tabpanel" aria-labelledby="details-tab"  tabindex="0">
                            <div class="mb-3">
                                <label for="">Orignal Price</label>
                                <input type="number" class="form-control" name="orignal_price" 
                                value="{{old('orignal_price',$product->orignal_price)}}">
                            </div> 
                            <div class="mb-3">
                                <label for="">Selling Price</label>
                                <input type="number " class="form-control" name="selling_price"
                                value="{{old('selling_price',$product->selling_price)}}">
                            </div>
                            <div class="mb-3">
                                <label for="">Quantity</label>
                                <input type="number" class="form-control" name="quantity"
                                value="{{old('quantity',$product->quantity)}}">
                            </div>
                            <div class="mb-3">
                                <label for="">Tranding:</label>
                                <input type="checkbox"  name="trending" {{$product->tracking == '1' ? 'checked' : ''}}>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <label for="">Status:</label>
                                <input type="checkbox"  name="status"  {{$product->status == '1' ? 'checked' : ''}}>
                            </div>
                            <div class="mb-3">
                              
                            </div>

                        </div>
                        <div class="tab-pane fade" id="image-tab-pane" role="tabpanel" aria-labelledby="image-tab"  tabindex="0">

                            <div class="mb-3">
                                <label for="">Upload Product Images</label>
                                <input type="file" class="form-control" name="image[]" multiple><br/>

                                @if($product->productImages)
                                <div class="row">
                                    @foreach($product->productImages as $image)
                                    <div class="col-md-1">
                                        <img src="{{asset($image->image)}}" width="120px" height="100px" class="me-4 border" alt="Product Image">
                                        &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; 
                                        <a href="{{ url('admin/product-image/'.$image->id.'/delete')}}" class="btn btn-danger">X</a>
                                    </div>
                                    @endforeach
                                </div>
                                @else
                                    <h5 class="badge bg-danger">No Product Image Available</h5>
                                @endif
                            </div>
                        </div>

                         
                         
                    </div>
                    <div>
                        <button type="submit" class="btn btn-success">Edit Products</button>
                        <a href="{{route('products.index')}}" class="btn btn-dark">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>    
@endsection