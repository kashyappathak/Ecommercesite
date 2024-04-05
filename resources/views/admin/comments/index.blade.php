@extends('layouts.master')

@section('content')
@if(Auth::check())
<div class="container"><br/><br/>
    <div class="card">
        <h2 style="text-align: center">Search For Commented Products</h2>
    </div><br/>
    
    <form action="{{url('admin/searchcomments')}}" method="GET"class="ms-auto">
        <div class="input-group">
            <input class="form-control" type="text" name="search" placeholder="Search for..." value="{{isset($search) ? $search : ''}} "aria-describedby="btnNavbarSearch" />
            <button class="btn btn-primary" id="btnNavbarSearch" type="submit"><i class="fas fa-search"></i></button>
        </div>
    </form>

    <div class="row justify-content-center">
        <div class="col-md-12"><br/><br/>
            <div class="card">
                <div class="card-header">
                    <h2 class="mb-0 text-center"> Manage User Comments</h2>
                </div>
                <div class="card-body">
                    @foreach ($products as $product)
                    @if ($product->comments()->count() > 0)
                    @foreach ($product->comments as $comment)
                    <div class="comment-container card card-body shadow-sm mt-3">
                        <div class="detail-area text-center" style="font-size: 20px;">
                            <img src="{{asset($comment->image)}}" alt="User Image" style="width: 90; border-radius: 50px;"><br/>
                            <p class="user-comment mb-0">
                                &nbsp;&nbsp;<br/><span>
                                    
                                    <span style="font-size:20px;font-weight:bold;">Product:{{$product->name}}</span>
                                    @if($comment->user)
                                    <p style="font-weight: bold;">Name: {{$comment->user->name}}&nbsp;
                                        @if($comment->user->role_as)
                                        <span class="badge bg-dark">
                                            {{ $comment->user->role_as == '1' ? 'SuperAdmin' : (auth()->user()->role_as == '0' ? 'Employee' : 'Customer') }}
                                        </span>
                                        @endif
                                    </p>
                                    @endif
                                </span>
                            </p>
                            <span class="text-primary" style="font-weight: bold;">Commented On: {{$comment->created_at->format('d-m-Y')}}</span>
                            <p class="user-comment mb-0" style="font-weight: bold;">Comment: {{$comment->comment}}</p><br/>
                            <form action="{{url('delete-comment',$comment->id)}}" method="POST" style="margin-left: 20px;margin-top:-26px;">
                                @csrf
                                @method('post')
                                <button type="submit" style="background-color: white;border:none" ><i class="fa fa-trash" style="color: black;"></i></button>
                            </form>
                        </div>
                    </div>
                    @endforeach
                    @else
                   
                    @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

@endif
@endsection
