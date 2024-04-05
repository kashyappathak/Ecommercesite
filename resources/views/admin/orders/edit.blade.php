@extends('layouts.master')

@section('content')
<br/>
@if (session('message'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('message') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
<div class="row">&nbsp;
   &nbsp;&nbsp;&nbsp;&nbsp; <div class="card col-md-6">
        <h2>Order </h2>
        <div >
            <br/>
            @if(Auth::user()->role_as =='1'  || Auth::user()->role_as=='0')
            <form action="{{route('orders.update',$order->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('put')
                @if($errors->any())
                <div class="alert alert-danger">
                    @foreach($errors->all() as $error)
                        <div>{{$error}}</div>
                    @endforeach
                </div>
                @endif
                    <div class="mb-3">
                      <label class="form-label" for="form-alignment-Name">Name</label>
                     @if(Auth::user()->role_as == '1') <input type="text" name="name" id="name" class="form-control" value="{{old('name',$order->name)}}" readonly>@else<input type="text" name="name" id="name" class="form-control" value="{{old('name',$order->name)}}" disabled>@endif
                    </div>
            
                    <div class="mb-3">
                        <label class="form-label" for="form-alignment-Quantity">Quantity</label>
                        @if(Auth::user()->role_as == '0')
                        <input type="number" name="quantity" id="quantity" class="form-control" value="{{ old('quantity', $order->quantity) }}" disabled>
                    @else
                        <input type="number" name="quantity" id="quantity" class="form-control" value="{{ old('quantity', $order->quantity) }}" readonly>
                    @endif
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="form-alignment-Total">Price</label>
                        @if(Auth::user()->role_as == '0')
                        <input type="text" name="selling_price" id="selling_price" class="form-control" value="{{ old('selling_price', $order->selling_price) }}" disabled>
                    @else
                        <input type="text" name="selling_price" id="selling_price" class="form-control" value="{{ old('selling_price', $order->selling_price) }}" readonly>
                    @endif
                    
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="form-alignment-Total">Total</label>
                        @if(Auth::user()->role_as == '0')
                        <input type="text" name="total" id="total" class="form-control" value="{{ old('total', $order->total) }}" disabled>
                    @else
                        <input type="text" name="total" id="total" class="form-control" value="{{ old('total', $order->total) }}" readonly>
                    @endif
                    </div>
            
                    <div class="mb-3">
                      <label>Status</label>
                      @if(Auth::user()->role_as =='1')
                      <select name="status" id="status" class="form-control" value="{{old('status',$order->status)}}">
                          <option value="0"{{$order->status == '0'? 'selected':''}}>pending</option>
                          <option value="1" {{$order->status == '1'? 'selected':''}}>Shipped</option>
                          <option value="2"{{$order->status == '2'? 'selected':''}}>Delivered</option>
                          <option value="3"{{$order->status == '3'? 'selected':''}}>Canceled</option>
                      </select>
                      @else
                      <select disabled name="status" id="status" class="form-control" value="{{old('status',$order->status)}}" >
                            <option value="0"{{$order->status == '0'? 'selected':''}}>pending</option>
                            <option value="1" {{$order->status == '1'? 'selected':''}}>Shipped</option>
                            <option value="2"{{$order->status == '2'? 'selected':''}}>Delivered</option>
                            <option value="3"{{$order->status == '3'? 'selected':''}}>Canceled</option>
                        </select>
                      @endif
                       <br/>
                    </div>
                    
                  
                    <div class="mb-3">
                        @if(Auth::user()->role_as == '1')
                        <label>Update Date</label>
                           
                            <input type="datetime-local" class="form-control" name="shipped_date" id="shipped_date" value="{{ $order->shipped_date}}">
                            @else
                            @endif
                         <br/>
                      </div>
                      
                    
                   
                    <div class="d-grid gap-2">
                      @if(Auth::user()->role_as == '1')<button type="submit" class="btn btn-primary waves-effect waves-light">Edit Orders</button>@endif
                    </div>
              
                
            </form>
            @endif
        </div>
        
         
        
    </div>
    <div class="col-md-4">
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
     
                  
                    <table class="table table-bordered " style="width:30vh;text-align:center;margin-left:30px;">
                        <tbody>
                        
                            <tr>
                                <th>Name</th>
                                <td>{{$orderitm->name}}</td>
                            </tr>
                            <tr>
                                <th>Quantity</th>
                                <td>{{$orderitm->quantity}}</td>
                            </tr>
                            <tr>
                                <th>Price</th>
                                <td>{{$orderitm->selling_price}}</td>
                            </tr>
                            <tr>
                                <th>Total</th>
                                <td>{{$orderitm->total}}</td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <td>  <span class="badge {{ $order->status == 0 ? 'bg-warning' : ($order->status == '1' ? 'bg-info' : ($order->status == '2' ? 'bg-success' : 'bg-danger')) }}" style="font-size: 15px;">

                                      
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
                                  <span style="font-size: 20px;">
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
    <div class="row">&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;<div class="col-md-4"> 
            <div class="card card-body">
            <h4>Shipping Order Details</h4>

            <div class="card-body">
                @if($Myorders->isEmpty())
                <span class="badge bg-danger" style="width: 40%; height:28px; font-size:17px;">No Orders Details Found</span>
                @else
                @foreach($Myorders as $Myorder)
                <table class="table table-bordered">
                    <tbody>
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
                </table><br/>
                <form action="{{ route('orderItem.delete', $Myorder->id) }}" method="post" style="margin-left: 20px; margin-top: -26px;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" style="background-color: white; border: none;">
                        <i class="fa fa-trash" style="color: rgb(10, 117, 240);"></i>
                    </button>
                </form>
                
                @endforeach

            
            @if(empty($Myorder))
                <span class="badge bg-danger" style="width: 40%;height:28px;font-size:17px;">No Orders Details Found</span>
            @endif
            @endif
            </div>
            </div>
        </div>
    </div>

</div>



@endsection