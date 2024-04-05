@extends('layouts.master')
@section('content')
&nbsp;&nbsp;&nbsp;
@if (session('message'))
<div class="alert alert-danger">{{session('message')}}</div>
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
                <h4>Edit Category
                    <a href="{{route('categories.index')}}" class="btn btn-dark float-end">Back</a>
                </h4>
            </div>
            <div class="card-body">
                <form action="{{route('categories.update',$category->id)}}" method="POST" enctype="multipart/form-data">
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
                            <label>Name:</label>
                            <input type="text" name="name" value="{{old('name', $category->name)}}" class="form-control">
                        </div>
        
                        <div class="mb-3">
                            <label>slug:</label>
                            <input type="text" name="slug" value="{{old('slug', $category->slug)}}" class="form-control">
                        </div>
        
                          
                        <div class="mb-3">
                            <label>description:</label>
                            <textarea name="description" id="mySummernote" class="form-control">{{$category->description}}</textarea>
                        </div>
        
                        <div class="mb-3">
                            <label>image:</label>
                            <input type="file" name="image" class="form-control">
                            <image src="{{asset($category->image)}}" width="50" height="50">
                        </div>
                    </div>
                

                    <h5>Meta Tags</h5>
                    <div class="mb-3">
                        <label for="">Category Meta_Title:</label>
                        <input type="text" name="meta_title" value="{{old('meta_title', $category->meta_title)}}"  placeholder="Please Enter Category Meta Title" class="form-control">
                    </div>   

                    <div class="mb-3">
                        <label for="">Category Meta_Description:</label>
                        <textarea type="text" name="meta_description" placeholder="Please Enter Category Meta Description" class="form-control">{{$category->meta_description}}</textarea>
                    </div>   

                    <div class="mb-3">
                        <label for="">Category Meta_keyword:</label>
                        <textarea type="text" name="meta_keyword" placeholder="Please Enter Category Meta Keyword" class="form-control">{{$category->meta_keyword}}</textarea>
                    </div> 
                    
                    <h5>Status Mode</h5>
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <label >Navbar_Status:</label>
                            <input type="checkbox" name="navbar_status" {{$category->navbar_status == '1'? 'checked':''}}>
                            &nbsp;  &nbsp; 
                            <label >Status:</label>
                            <input type="checkbox" name="status" {{$category->status == '1'? 'checked':''}}>
                        </div>
                    
                        <div>
                            <button type="submit" class="btn btn-success">Edit Category</button>
                            <a href="{{route('categories.index')}}" class="btn btn-dark">Cancel</a>

                        </div>
                </form>
            </div>
        </div>
    </div>
 </div>

@endsection