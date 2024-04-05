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
                <h4>Add Category
                    <a href="{{route('categories.index')}}" class="btn btn-dark float-end">Back</a>
                </h4>
            </div>
            <div class="card-body">
                <form action="{{route('categories.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
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
                            <input type="text" name="name" class="form-control">
                        </div>
        
                        <div class="mb-3">
                            <label>slug:</label>
                            <input type="text" name="slug" class="form-control">
                        </div>
        
                          
                        <div class="mb-3">
                            <label>description:</label>
                            <textarea name="description" id="mySummernote" class="form-control"></textarea>
                        </div>
        
                        <div class="mb-3">
                            <label>image:</label>
                            <input type="file" name="image" class="form-control">
                        </div>
                    </div>
                

                    <h5>Meta Tags</h5>
                    <div class="mb-3">
                        <label for="">Category Meta_Title:</label>
                        <input type="text" name="meta_title" placeholder="Please Enter Category Meta Title" class="form-control">
                    </div>   

                    <div class="mb-3">
                        <label for="">Category Meta_Description:</label>
                        <textarea type="text" name="meta_description" placeholder="Please Enter Category Meta Description" class="form-control"></textarea>
                    </div>   

                    <div class="mb-3">
                        <label for="">Category Meta_keyword:</label>
                        <textarea type="text" name="meta_keyword" placeholder="Please Enter Category Meta Keyword" class="form-control"></textarea>
                    </div> 
                    
                    <h5>Status Mode</h5>
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <label >Navbar_Status:</label>
                            <input type="checkbox" name="navbar_status">
                            &nbsp;  &nbsp; 
                            <label >Status:</label>
                            <input type="checkbox" name="status">
                        </div>
                    
                        <div>
                            <button type="submit" class="btn btn-success">Save Category</button>
                            <a href="{{route('categories.index')}}" class="btn btn-dark">Cancel</a>

                        </div>
                </form>
            </div>
        </div>
    </div>
 </div>

@endsection