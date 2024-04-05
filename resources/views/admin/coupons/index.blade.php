@extends('layouts.master')


@section('content')
@if (session('status'))
    <div class="alert alert-success alert-dismissible fade show">
        {{ session('status') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
@if (session('message'))
<div class="alert alert-success">{{session('message')}}</div>
@endif
<div class="row">
    &nbsp;&nbsp;
    <div class="col-md-11" style="width:99%">
        <div class="card">
           
            <div class="card-header">
                <h4>Coupens
                    @if(Auth::user()->role_as == '1')<a href="{{route('coupons.create')}}" class="btn btn-dark float-end">Create</a>@endif
                </h4>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-bordered table-group-divider" id="myDatatable">  
                    <thead>
                        <th>ID</th>
                        <th>Coupen_name</th>
                        <th>Coupon_discount</th>
                        <th>Status</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        @foreach($coupons as $coupon)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td><span class="badge {{ $coupon->status == 1 ? 'bg-success' : 'bg-danger' }}" style="font-size: 15px;">{{$coupon->coupon_name}}</span></td>
                            <td>{{$coupon->discount}}%</td>
                            <td>
                                @if($coupon->status == '1')
                                    <span class="badge bg-success" style="font-size: 15px;">Active</span>
                                @else
                                    <span class="badge bg-danger" style="font-size: 15px;">Inactive</span>
                                @endif
                            </td>
                            

                            <td>
                                @if(Auth::user()->role_as == '1')
                                <a href="{{route('coupons.edit',$coupon->id)}}">  <span class="svg-icon svg-icon-md">
                                   <i class="fas fa-eye" style="height: 20px;width:20px;color:black"></i>
                                    
                                </span></a>
                                
                                <form action="{{ route('coupons.destroy', $coupon->id) }}" method="POST" style="margin-left: 20px;margin-top:-28px;">
                                    @csrf
                                    @method('DELETE')&nbsp;

                                    <button type="submit" style="background-color: white;border:none">
                                        <i class="fa fa-trash" aria-hidden="true"></i>

                                        </span>
                                    </button>
                                    @endif
                                    <a href="{{ $coupon->status == 1 ? route('coupons.inactive', ['id' => $coupon->id]) : route('coupons.active', ['id' => $coupon->id]) }}" class="badge {{ $coupon->status == 1 ? 'bg-success' : 'bg-danger' }}" style="border-radius:30px;width:40px;">
                                        <span class="svg-icon svg-icon-md">
                                            <i class="fas fa-toggle-off" style="height: 20px; width: 20px; color: black;"></i>
                                        </span>
                                    </a>
                                </form>
                             
                                
                              
                            </td>
                        </tr>
                   
                        


                             
                    
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection