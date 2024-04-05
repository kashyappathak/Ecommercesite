@extends('layouts.app')


@section('content')
@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
<div class="row">
    &nbsp;&nbsp;
   
    <div class="col-md-6" >
        <div class="card">
           
            <div class="card-header">
                <h4>Profile    <a href="{{url('/Front')}}" class="btn btn-primary" style="width:70px;height:40px">Home</a>
                    <a class="btn btn-danger float-end" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                                  document.getElementById('logout-form').submit();">
                     {{ __('Logout') }}
                    </a>
                  
    
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>  
                </h4>
            </div>
            <div class="card-body">

                <form class="w-px-400 border rounded p-3 p-md-3" action="{{url('profiles',Auth::user()->id)}}"  method="POST">
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
                      <label class="form-label" for="form-alignment-username">Name:</label>
                      <input type="text" name="name" id="name" class="form-control" value="{{old('name',Auth::user()->name)}}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="form-alignment-username">Email:</label>
                        <input type="text" name="email" id="email" class="form-control" value="{{old('email',Auth::user()->email)}}">
                    </div>

                    <div class="mb-3">
                      <label>Role as:</label>
                      <select name="role_as" id="role_as" class="form-control" disabled>
                          <option value="1" {{Auth::user()->role_as == '1'? 'selected':''}}>SuperAdmin</option>
                          <option value="0"{{Auth::user()->role_as == '0'? 'selected':''}}>Employee</option>
                          <option value="2"{{Auth::user()->role_as == '2'? 'selected':''}}>Customer</option>
                      </select>
                       <br/>
                    </div>
                    
                    <div class="mb-3 form-password-toggle">
                      <label class="form-label" for="form-alignment-password">Password:</label>
                      <div class="input-group input-group-merge">
                        <input type="password" id="password" name="password" class="form-control" placeholder="············" aria-describedby="form-alignment-password2" value="{{old('password',Auth::user()->password)}}" readonly>
                        <span class="input-group-text cursor-pointer" id="form-alignment-password2"><i class="ti ti-eye-off"></i></span>
                      </div>
                    </div>
                   
                    <div class="d-grid gap-2">
                      <button type="submit" class="btn btn-primary waves-effect waves-light">Save Changes</button>
                    </div>
              
                </form>
            </div>
          
        </div>
    </div>
    <div class="col-md-5">
        <div class="card">
           
            <div class="card-header">
                <h4>Profile View
                 
                </h4>
            </div>
            <div class="card-body">
                <table class="table table table-bordered">
                    <tbody>
                        <tr>
                            <th>Name:</th>
                            <td>{{ Auth::user()->name }}</td>
                        </tr>
                        <tr>
                            <th>Email:</th>
                            <td>{{ Auth::user()->email }}</td>
                        </tr>
                        <tr>
                            <th>Role:</th>
                            <td>
                                <span class="badge bg-dark">
                                    {{ Auth::user()->role_as == '1' ? 'SuperAdmin' : (Auth::user()->role_as == '0' ? 'Employee' : 'Customer') }}
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <th>Created At:</th>
                            <td><span class="badge bg-dark">{{ Auth::user()->created_at->format('d-m-Y') }}</span>
                            </td>
                        </tr>
                    </tbody>
                </table>
               
            </div>
        </div><br/>
        
       
        <div class="col-md-4" style="width:99%">
            <div class="card">   
                <div class="card-header">
                    <h4> My Orders</h4>     
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
                        </thead>
                        <tbody>
                            
                            @foreach($orders as $order)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td style="font-size: 20px;">
                                        {{-- @if(Auth::user()->role_as == 1 || Auth::user()->role_as =='0' || Auth::user()->rol) --}}
                                        @if($order->user)
                                            @if($order->user->role_as == 1)
                                                <span class="badge bg-success"><i class="fas fa-crown"></i> SuperAdmin</span>
                                            @elseif($order->user->role_as == 0)
                                                <span class="badge bg-primary"><i class="fas fa-user-tie"></i> Employee</span>
                                            @else
                                                <span class="badge bg-danger"><i class="fas fa-user"></i> Customer</span>
                                            @endif
                                        @endif
                                    {{-- @endif --}}
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
                                                                                             
                                </tr>
                            @endforeach
                
                        </tbody>
                    </table>
                   
                </div>
            </div>
        </div>
        
    </div>
</div>

@endsection