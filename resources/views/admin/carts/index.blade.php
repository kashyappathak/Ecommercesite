@extends('layouts.master')
@section('content')
@if (session('message'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('message') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
<br/>
<div class="row">
    &nbsp;&nbsp;
    <div class="col-md-11" style="width:99%">
        <div class="card">   
            <div class="card-header">
                <h4>Carts</h4>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-bordered table-group-divider" id="myDatatable">  
                    <thead>
                        <th>ID</th>
                        <th>Role</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Total</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        @foreach($carts as $cart)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td style="font-size: 20px;">
                                    @if(Auth::user()->role_as == 1 || Auth::user()->role_as =='0')
                                    @if($cart->user)
                                        @if($cart->user->role_as == 1)
                                            <span class="badge bg-success"><i class="fas fa-crown"></i> SuperAdmin</span>
                                        @elseif($cart->user->role_as == 0)
                                            <span class="badge bg-primary"><i class="fas fa-user-tie"></i> Employee</span>
                                        @else
                                            <span class="badge bg-danger"><i class="fas fa-user"></i> Customer</span>
                                        @endif
                                    @endif
                                @endif
                                </td>
                                <td>
                                    @php
                                        $productImages = $cart->products->productImages;
                                    @endphp

                                    @if ($productImages->isNotEmpty())
                                        {{-- Display only the first image --}}
                                        <img class="card-img-top" src="{{ asset($productImages->first()->image) }}" style="width: 10%;">
                                    @else
                                        <span>No Image Available</span>
                                    @endif
                                </td>
                               <td><span class="badge bg-success" style="font-size: 17px;">{{$cart->name}}</span></td>
                                <td><span class="badge bg-success" style="font-size:17px;">{{$cart->quantity}}</span></td>
                                <td ><span class="badge bg-secondary" style="font-size:17px;">{{$cart->selling_price}}&nbsp;Rs.</span></td>
                                <td><span class="badge bg-info" style="font-size:17px;">
                                    {{$cart->selling_price*$cart->quantity}}Rs.
                                </td>&nbsp;
                               
                                <td>
                                    @if(Auth::user()->role_as == '1'  || Auth::user()->role_as =='0')

                                    <a href="{{route('carts.edit',$cart->id)}}">  <span class="svg-icon svg-icon-md">
                                       <i class="fas fa-eye"></i>
                                        
                                    </span></a>
                                    @endif
                                    @if(Auth::user()->role_as =='1')
                                    <form action="{{route('carts.destroy',$cart->id)}}" method="post" style="margin-left: 20px; margin-top: -26px;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" style="background-color: white; border: none;">
                                            <i class="fa fa-trash" style="color: rgb(10, 117, 240);"></i>
                                        </button>
                                    </form>
                                    
                                    @endif
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