@extends('layouts.app')
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
                <h4>Orders             
                {{-- <a href="{{url('invoice-pdf')}}" class="btn btn-danger float-end" style="font-weight: bold;color:white"><i class="fa-solid fa-file-export"></i>&nbsp;Download PDF</a> --}}
                @foreach($orderItem as $item)
                @if($item->status == 0 || $item->status == 1)
                    <a href="{{ url('invoice-pdf/{id}') }}" class="btn btn-danger mb-3 mb-md-0 me-md-3 float-end"style="font-weight: bold;color:white" ><i class="fa-solid fa-file-export"></i>&nbsp;&nbsp;Download PDF</a>
                    
                     <a href="{{ url('send-email-pdf') }}" class="float-end btn btn-info"  style="font-weight: bold;color:white;"><i class="fa fa-envelope" aria-hidden="true"></i>&nbsp;&nbsp;Check Out
                    </a>
                    @break
                @endif
               @endforeach
                </h4>          
            </div>
            <div class="card-body table-responsive">
                <table class="table table-bordered table-striped table-group-divider" id="myDatatable">  
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
                        @foreach($orderItem as $order)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td style="font-size: 20px;">
                                    
                                    @if($order->user)
                                        @if($order->user->role_as == 1)
                                            <span class="badge bg-success"><i class="fas fa-crown"></i> SuperAdmin</span>
                                        @elseif($order->user->role_as == 0)
                                            <span class="badge bg-primary"><i class="fas fa-user-tie"></i> Employee</span>
                                        @else
                                            <span class="badge bg-danger"><i class="fas fa-user"></i> Customer</span>
                                        @endif
                                    @endif
                                
                                </td>
                                <td><span class="badge {{$order->status == 0 ? 'bg-warning' : ($order->status == '1' ? 'bg-info' : ($order->status == '2' ? 'bg-success' : 'bg-danger'))}}" style="font-size:17px;">{{$order->name}}</td></span>
                                <td><span class="badge bg-success" style="font-size:17px;">{{$order->quantity}}</span></td>
                                <td ><span class="badge bg-secondary" style="font-size:17px;">{{$order->selling_price}}&nbsp;Rs-/-</span></td>
                                <td>
                                        @if(Session::has('coupon'))
                                            <span class="badge bg-dark" style="font-size:16px;">{{ session()->get('coupon')['discount'] }}% ({{ $discount = $order->total * session()->get('coupon')['discount'] / 100 }} Rs.)</span><br/><br/>
                                            <div class="h5">Discount Price:</div>
                                            <span class="badge bg-dark" style="font-size: 16px;">Rs.{{ $order->total - $discount }}</span>
                                        @else
                                            <span class="badge bg-info" style="font-size:17px;">{{ $order->total }} Rs-/-</span>
                                        @endif
                                </td>
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
                                    <a href="{{url('myorders/view',$order->id)}}" class="btn btn-success" style="font-weight: bold;color:white"><i class="fas fa-spinner fa-spin"></i></a>                                                                          
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