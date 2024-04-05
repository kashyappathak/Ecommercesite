@extends('layouts.master')

@section('content')
<div class="container-fluid px-4">
    <div class="row">
        <div class="col-md-12">
            @if (session('message'))
             <div class="alert alert-success">{{session('message')}}</div>
            
            @endif
            <div class="card-header">
                <h1>Website Setting</h1>
            </div>
          <div class="card-body">
            @if(Auth::user()->role_as == '1')
                    <form action="{{url('admin/setting')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label>Website Name</label>
                            <input type="text" name="website_name" required @if($setting) value="{{ $setting->website_name }}" @endif class="form-control"/>
                        </div>
                        <div class="mb-3">
                            <label>Website Logo</label>
                            <input type="file" name="website_logo"  class="form-control"/>
                            @if($setting)
                                <img src="{{asset('uploads/settings/'.$setting->logo)}}" width="100px" alt="logo">
                            @endif
                        </div> <div class="mb-3">
                            <label>Website Favicon</label>
                            <input type="file" name="website_favicon" class="form-control"/>
                            @if($setting)
                            <img src="{{asset('uploads/settings/'.$setting->favicon)}}" width="100px" alt="logo">
                        @endif
                        </div> <div class="mb-3">
                            <label>Description</label>
                            <textarea name="description" required  class="form-control" rows="3">@if($setting) {{ $setting->description }} @endif</textarea>
                        </div>
                        <h3>SEO Tags</h3>
                         <div class="mb-3">
                            <label>Meta Title</label>
                            <input type="text" name="meta_title" required @if($setting) value="{{ $setting->meta_title }}" @endif class="form-control"/>
                        </div>
                         <div class="mb-3">
                            <label>Meta Keyword</label>
                            <textarea name="meta_keyword" required class="form-control"> @if($setting) {{ $setting->meta_keyword }} @endif</textarea>
                        </div>
                        <div class="mb-3">
                            <label>Meta Description</label>
                            <textarea name="meta_description" class="form-control">@if($setting) {{ $setting->meta_description }} @endif </textarea>
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Changes Made</button>
                            <a href="{{url('admin/dashboard')}}" class="btn btn-secondary">Cancel</a>

                        </div>
                    </form>
                </div>
            @endif    
            </div>
        </div>
    </div>

@endsection