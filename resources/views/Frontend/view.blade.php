@extends('layouts.app')

@section('content')
<br/>
@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
<div class="row">
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<div class="col-md-4">
    <div class="card">
        <h2>Order Details</h2>
        <div>
           
                @foreach($orderItems as $orderitm)
                       
                @php
                    $productImages = $orderitm->products->productImages;
                @endphp
 
                @if ($productImages->isNotEmpty())
                    {{-- Display only the first image --}}
                    <img class="card-img-top" src="{{ asset($productImages->first()->image) }}" style="width: 40%;margin-left:30px;">
                @else
                    <span>No Image Available</span>
                @endif
 
              
                <table class="table table-bordered table-responsive">
                    <tbody>
                    
                        <tr>
                            <th>Name</th>
                            <td><span class="badge {{ $order->status == 0 ? 'bg-warning' : ($order->status == '1' ? 'bg-info' : ($order->status == '2' ? 'bg-success' : 'bg-danger')) }}" style="font-size: 17px;">{{$orderitm->name}}<span</td>
                        </tr>
                        <tr>
                            <th>Quantity</th>
                            <td style="font-size:17px;">{{$orderitm->quantity}}</td>
                        </tr>
                        <tr>
                            <th>Price</th>
                            <td style="font-size:17px;">{{$orderitm->selling_price}}</td>
                        </tr>
                        <tr>
                            <th>Total</th>
                           <td>
                            @if(Session::has('coupon'))
                            <span class="badge bg-dark" style="font-size:16px;">{{ session()->get('coupon')['discount'] }}% ({{ $discount = $orderitm->total * session()->get('coupon')['discount'] / 100 }} Rs.)</span><br/><br/>
                            <div class="h5">Discount Price:</div>
                            <span class="badge bg-dark" style="font-size: 16px;">Rs.{{ $orderitm->total - $discount }}</span>
                        @else
                            <span class="badge bg-info" style="font-size:17px;">{{ $orderitm->total }} Rs-/-</span>
                        @endif
                           </td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>  <span class="badge {{ $order->status == 0 ? 'bg-warning' : ($order->status == '1' ? 'bg-info' : ($order->status == '2' ? 'bg-success' : 'bg-danger')) }}" style="font-size: 17px;">

                                  
                            @if($order->status == '0')
                               <i class="fas fa-shield-alt"></i> pending
                            @elseif($order->status == '1')
                                <i class="fa-solid fa-truck"></i> shipped
                            @elseif($order->status == '2')
                                <i class="fa-solid fa-check"></i> Delivered
                            @else
                                X Canceled
                            @endif
                        </td>
                        </tr>
                        <tr>
                            <th>Loggedin User</th>
                            <td>
                              <span>
                                @if(Auth::user()->role_as == 1 || Auth::user()->role_as =='0')
                                @if($order->user)
                                    @if($order->user->role_as == 1)
                                        <span class="badge bg-success" style="font-size: 17px;"><i class="fas fa-crown"></i> SuperAdmin</span>
                                    @elseif($order->user->role_as == 0)
                                        <span class="badge bg-primary" style="font-size: 17px;"><i class="fas fa-user-tie"></i> Employee</span>
                                    @else
                                        <span class="badge bg-danger" style="font-size: 17px;"><i class="fas fa-user"></i> Customer</span>
                                    @endif
                                @endif
                            @endif
                              </span>
                            </td>
                            
                        </tr>
                    </tbody>
                </table>
               
                @endforeach
           
        </div>
    </div>
    &nbsp;&nbsp;<br/> 
</div>

    &nbsp;&nbsp;&nbsp;&nbsp;<div class="col-md-5"> 
        <div class="card card-body">
        <h4>Shipping Order Details</h4>

        <div class="table-responsive">
            @if($Myorders->isEmpty())
            <span class="badge bg-danger" style="width: 40%; height:28px; font-size:17px;">No Orders Details Found</span>
            @else
            @foreach($Myorders as $Myorder)
            <table class="table table-bordered">
                <tbody style="font-size: 20px;">
                    <tr>
                        <th>First Name</th>
                        <td><span class="badge bg-dark">{{$Myorder->first_name}}</span></td>
                    </tr>
                    <tr>
                        <th>Last Name</th>
                        <td><span class="badge bg-dark">{{$Myorder->last_name}}</span></td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td><span class="badge bg-dark">{{$Myorder->email}}</span></td>
                    </tr>
                    <tr>
                        <th>Phone</th>
                        <td><span class="badge bg-dark">{{$Myorder->mobile}}</span></td>
                    </tr>
                    <tr>
                        <th>Address:</th>
                        <td><span class="badge bg-dark">{{$Myorder->address}}</span></td>
                    </tr>
                    <tr>
                        <th>Apartment:</th>
                        <td><span class="badge bg-dark">{{$Myorder->apartment}}</span></td>
                    </tr>
                    <tr>
                        <th>City:</th>
                        <td><span class="badge bg-dark">{{$Myorder->city}}</span></td>
                    </tr>
                    <tr>
                        <th>State:</th>
                        <td><span class="badge bg-dark">{{$Myorder->state}}</span></td>
                    </tr>
                    <tr>
                        <th>Zip:</th>
                        <td><span class="badge bg-dark">{{$Myorder->zip}}</span></td>
                    </tr>
                    
                
                </tbody>
            </table>
            @endforeach

        
        @if(empty($Myorder))
            <span class="badge bg-danger" style="width: 40%;height:28px;font-size:17px;">No Orders Details Found</span>
        @endif
        @endif
        </div>
        </div>
    </div>
    <div class="col-md-2">
        @if($orderitm->status == '0' || $orderitm->status == '1')
        <div class="card">
          
            <h3>Cancel Order</h3>
            <div class="card-body">
    
                @if($orderitm->status != 'Canceled')
                <a href="{{ route('order.cancel', ['id' => $orderitm->id]) }}" class="btn btn-outline-dark" style="background-color:white;color:black">Cancel Order</a>
    
    
            @endif
            </div>
            <div class="card-footer">
                @if($orderitm->status == '3')
                <a href="{{ url('myorders') }}" class="btn btn-outline-dark btn-block">View Canceled Orders</a>
            @endif
            </div>
            @endif

        </div>
    
</div>

@endsection