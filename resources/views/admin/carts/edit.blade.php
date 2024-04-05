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
        &nbsp;&nbsp;&nbsp;&nbsp;
        <div class="card col-md-6">
            <h2>Edit Cart Item</h2>
            <div>
                <br/>
                <form action="{{ route('carts.update', $cart->id) }}" method="post">
                    @csrf
                    @method('put')
                    @if($errors->any())
                        <div class="alert alert-danger">
                            @foreach($errors->all() as $error)
                                <div>{{ $error }}</div>
                            @endforeach
                        </div>
                    @endif
                    <div class="mb-3">
                        <label class="form-label" for="role_as" style="font-size: 17px;">Role:</label>
                        @if(Auth::user()->role_as == 1 || Auth::user()->role_as =='0')
                        @if($cart->user)
                            @if($cart->user->role_as == 1)
                                <span class="badge bg-success" style="font-size: 17px;"><i class="fas fa-crown"></i> SuperAdmin</span>
                            @elseif($cart->user->role_as == 0)
                                <span class="badge bg-primary" style="font-size: 17px;"><i class="fas fa-user-tie"></i> Employee</span>
                            @else
                                <span class="badge bg-danger" style="font-size: 17px;"><i class="fas fa-user"></i> Customer</span>
                            @endif
                        @endif
                        @endif
                    </div>    
                    <div class="mb-3">
                        <label class="form-label" for="name">Name</label>
                        @if(Auth::user()->role_as == '1') <input type="text" name="name" id="name" class="form-control"  value="{{ $cart->name }}" readonly>@else<input type="text" name="name" id="name" class="form-control"  value="{{ $cart->name }}" disabled>@endif
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="selling_price">Price</label>
                      
                        @if(Auth::user()->role_as == '0')
                        <input type="text" name="selling_price" id="selling_price" class="form-control"value="{{ $cart->selling_price }}" disabled>
                    @else
                        <input type="text" name="selling_price" id="selling_price" class="form-control" value="{{ $cart->selling_price }}" readonly>
                    @endif
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="quantity">Quantity</label>
                       
                        @if(Auth::user()->role_as == '0')
                        <input type="number" name="quantity" id="quantity" class="form-control" value="{{ $cart->quantity }}" disabled>
                    @else
                        <input type="number" name="quantity" id="quantity" class="form-control"value="{{ $cart->quantity }}">
                    @endif
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="total">Total</label>
                     
                        @if(Auth::user()->role_as == '0')
                        <input type="text" name="total" id="total" class="form-control" value="{{ $cart->selling_price*$cart->quantity }}"disabled>
                    @else
                        <input type="text" name="total" id="total" class="form-control" value="{{ $cart->selling_price*$cart->quantity }}" readonly>
                    @endif
                    </div>

                    @if(Auth::user()->role_as == 1)<button type="submit" class="btn btn-primary">Update</button>@else<button type="submit" class="btn btn-primary" disabled>Update</button>@endif
                </form>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h2>Cart Details</h2>
                    <div>
                        @if($cart)
                        <table class="table table-bordered" style="width:30vh;text-align:center;margin-left:30px;">
                            <tbody>
                                <tr>
                                    <th>Product Image</th>
                                    <td>
                                        @php
                                        $productImages = $cart->products->productImages;
                                         @endphp

                                        @if ($productImages->isNotEmpty())
                                        {{-- Display only the first image --}}
                                        <img class="card-img-top" src="{{ asset($productImages->first()->image) }}" style="width: 30%;">
                                         @else
                                        <span>No Image Available</span>
                                         @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Name</th>
                                    <td>{{$cart->name}}</td>
                                </tr>
                                <tr>
                                    <th>Quantity</th>
                                    <td>{{$cart->quantity}}</td>
                                </tr>
                                <tr>
                                    <th>Price</th>
                                    <td>{{$cart->selling_price}}</td>
                                </tr>
                                <tr>
                                    <th>Total</th>
                                    <td>{{$cart->selling_price*$cart->quantity}}</td>
                                </tr>
                                
                            </tbody>
                        </table>
                    @else
                        <p class="badge bg-danger">No cart found with the provided ID.</p>
                    @endif
                    
                </div>
                </div>
            </div>
        </div>
    </div>
@endsection
