@extends('layouts.app')

@section('content')
  @if (session('message'))
    <h6 class="alert alert-success mb-3">{{session('message')}}</h6>
  @endif
  @if (session('danger'))
  <h6 class="alert alert-danger mb-3">{{session('danger')}}</h6>
@endif
<div class="card">
    <h2>Edit Comment</h2>
</div>
@if(Auth::check())
<div class="comment-area mt-4 " style="margin-left: 15%;">
    <a href="{{url()->previous()}}" class="btn bg-secondary text-white " style="margin-left: 80%;">Back</a>
    <div class="card card-body col-md-10">
        <h6 class="card-title">Leave Comment:</h6>
        <form action="{{url('update-comment/'.$comment->id)}}" method="POST">
        @csrf
        <input type="hidden" name="p_slug" >

        <textarea name="comment" class="form-control" rows="3" required >{{$comment->comment}}</textarea>
        <button type="submit" class="btn btn-primary mt-3">Edit Comment</button>
        </form>
    </div>
</div>
@endif
@endsection