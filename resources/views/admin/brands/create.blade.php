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
                <h4>Add Brands
                    <a href="{{route('brands.index')}}" class="btn btn-dark float-end">Back</a>
                </h4>
            </div>
            <div class="card-body">
                <form action="{{route('brands.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @if($errors->any())
                    <div class="alert alert-danger">
                        @foreach($errors->all() as $error)
                            <div>{{$error}}</div>
                        @endforeach
                    </div>
                    @endif
                    <div class="row">
                        <div class="mb-3"                          
                            <label for="">Category:</label>
                            <select name="category_id" class="form-control">
                              @foreach($category as $cat)
                              <option value="{{$cat->id}}">{{$cat->name}}</option>
                              @endforeach
                            </select>
                        </div>
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
                            <button type="submit" class="btn btn-success">Save Brand</button>
                            <a href="{{route('brands.index')}}" class="btn btn-dark">Cancel</a>

                        </div>
                </form>
            </div>
        </div>
    </div>
 </div>

@endsection