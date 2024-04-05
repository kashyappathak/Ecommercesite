@extends('layouts.master')
@section('content')
&nbsp;&nbsp;&nbsp;
@if (session('message'))
<div class="alert alert-danger">{{session('message')}}</div>

@endif
 <div class="row">
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <div class="col-md-11">
        <div class="card">
            <div class="card-header">
                <h4>Edit Brands
                    <a href="{{route('brands.index')}}" class="btn btn-dark float-end">Back</a>
                </h4>
            </div>
            <div class="card-body">
                <form action="{{route('brands.update',$brand->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    @if($errors->any())
                    <div class="alert alert-danger">
                        @foreach($errors->all() as $error)
                            <div>{{$error}}</div>
                        @endforeach
                    </div>
                    @endif
                    <div class="row">
                        <div class="mb-3">
                            <label for="">Brand Category:</label>
                            <select name="category_id" class="form-control">
                             
                                @foreach($category as $cat)
                                <option value="{{$cat->id}}" {{$brand->category_id ==  $cat->id ? 'selected':''}}>{{$cat->name}}</option>
                                @endforeach
    
                            </select>
                        </div>

                        <div class="mb-3">
                            <label>Name:</label>
                            <input type="text" name="name" value="{{old('name',$brand->name)}}" class="form-control">
                        </div>
        
                        <div class="mb-3">
                            <label>slug:</label>
                            <input type="text" name="slug"   value="{{old('slug',$brand->slug)}}" class="form-control">
                        </div>
        
                          
                        <div class="mb-3">
                            <label>description:</label>
                            <textarea name="description" id="mySummernote" class="form-control">{{$brand->description}}</textarea>
                        </div>
        
                       
                    </div>
                    <h5>Status Mode</h5>
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <label >Navbar_Status:</label>
                            <input type="checkbox" name="navbar_status" {{$brand->navbar_status == '1' ? 'checked':''}}>
                            &nbsp;  &nbsp; 
                            <label >Status:</label>
                            <input type="checkbox" name="status" {{$brand->navbar_status == '1' ? 'checked':''}}>
                        </div>
                    
                        <div>
                            <button type="submit" class="btn btn-success">Edit Brand</button>
                            <a href="{{route('brands.index')}}" class="btn btn-dark">Cancel</a>

                        </div>
                </form>
            </div>
        </div>
    </div>
 </div>

@endsection