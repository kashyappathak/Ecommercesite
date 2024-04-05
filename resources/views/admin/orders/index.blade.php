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
                <h4>Orders</h4>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-bordered table-group-divider" id="myDatatable">  
                    <thead>
                        <th>ID</th>
                        <th>Log User</th>
                        <th>Name</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td style="font-size: 20px;">
                                    @if(Auth::user()->role_as == 1 || Auth::user()->role_as =='0')
                                    @if($order->user)
                                        @if($order->user->role_as == 1)
                                            <span class="badge bg-success"><i class="fas fa-crown"></i> SuperAdmin</span>
                                        @elseif($order->user->role_as == 0)
                                            <span class="badge bg-primary"><i class="fas fa-user-tie"></i> Employee</span>
                                        @else
                                            <span class="badge bg-danger"><i class="fas fa-user"></i> Customer</span>
                                        @endif
                                    @endif
                                @endif
                                </td>
                                <td><span class="badge {{$order->status == 0 ? 'bg-warning' : ($order->status == '1' ? 'bg-info' : ($order->status == '2' ? 'bg-success' : 'bg-danger'))}}" style="font-size:17px;">{{$order->name}}</td></span>
                                <td><span class="badge bg-success" style="font-size:17px;">{{$order->quantity}}</span></td>
                                <td ><span class="badge bg-secondary" style="font-size:17px;">{{$order->selling_price}}&nbsp;Rs-/-</span></td>
                                <td><span class="badge bg-info" style="font-size:17px;">{{$order->total}}&nbsp;Rs-/-</span></td>
                                <td>
                                    <span class="badge {{ $order->status == 0 ? 'bg-warning' : ($order->status == '1' ? 'bg-info' : ($order->status == '2' ? 'bg-success' : 'bg-danger')) }}" style="font-size: 17px;">
                                        @if($order->status == '0')
                                           <i class="fas fa-shield-alt"></i> pending
                                        @elseif($order->status == '1')
                                        <i class="fa-solid fa-truck"></i> shipped
                                        @elseif($order->status == '2')
                                            <i class="fas fa-check"></i> Delivered
                                        @else
                                            X Canceled
                                        @endif
                                    </span>
                                  </td>
                                <td>
                                    @if(Auth::user()->role_as == '1'  || Auth::user()->role_as =='0')

                                    <a href="{{route('orders.edit',$order->id)}}">  <span class="svg-icon svg-icon-md">
                                       <i class="fas fa-eye"></i>
                                        
                                    </span></a>
                                    @endif
                                    @if(Auth::user()->role_as =='1')
                                    <form action="{{ route('orders.destroy',$order->id)}}" method="post" style="margin-left: 20px; margin-top: -26px;">
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