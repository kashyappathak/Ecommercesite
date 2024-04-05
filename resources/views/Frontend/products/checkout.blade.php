@extends('layouts.app')
@section('title','Ecommerce App| Checkout')
@section('content')
@if (session('success'))
<div class="alert alert-success alert-dismissible fade show">{{session('success')}}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
<section class="section-5 pt-3 pb-3 mb-3 bg-white">
    <div class="container">
        <div class="light-font">
            <ol class="breadcrumb  mb-0">
                <li class="breadcrumb-item"><a class="btn btn-light border text-black  text-decoration-none" style="width: 10vh;font-size:20px;font-weight:bold;" href="{{url('/Front')}}">Home </a></li>        

            </ol>
        </div>
    </div>
</section>

<section class="section-9 pt-4">
    <div class="container">
        <form action="{{url('process-checkout/' . auth()->id())}}" method="post">
            @csrf
            @method('post')
            @if($errors->any())
            <div class="alert alert-danger">
                @foreach($errors->all() as $error)
                    <div>{{$error}}</div>
                @endforeach
            </div>
            @endif
            <div class="row">
                <div class="col-md-8">
                    <div class="sub-title">
                        <h2>Shipping Address</h2>
                    </div>
                    <div class="card-shadow">
                        <div class="card-body checkout-form">
                            <div class="row">

                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <input type="text" name="first_name" id="first_name" class="form-control" placeholder="First Name"  value="{{old('first_name')}}">
                                        <p></p>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <input type="text" name="last_name" id="last_name" class="form-control" placeholder="Last Name"  value="{{old('last_name')}}">
                                        <p></p>

                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <input type="text" name="email" id="email" class="form-control" placeholder="Email" value="{{old('email')}}">
                                        <p></p>

                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <select name="country" id="country" class="form-control">
                                            <option value="">Select a Country</option>
                                            @if ($countries->isNotEmpty())
                                            @foreach ($countries as $country)
                                             <option value="{{$country->id}} {{ old('country') == $country->id ? 'selected' : '' }}">{{$country->name}}</option>

                                            @endforeach

                                            @endif
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <textarea name="address" id="address" cols="30" rows="3" placeholder="Address" class="form-control">{{old('address')}}</textarea>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <input type="text" name="apartment" id="apartment" class="form-control" placeholder="Apartment, suite, unit, etc. (optional)" value="{{old('apartment')}}">
                                        <p></p>

                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <input type="text" name="city" id="city" class="form-control" placeholder="City" value="{{old('city')}}">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <input type="text" name="state" id="state" class="form-control" placeholder="State" value="{{old('state')}}">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <input type="text" name="zip" id="zip" class="form-control" placeholder="Zip" value="{{old('zip')}}">
                                        <p></p>

                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <input type="phone" name="mobile" id="mobile" class="form-control" placeholder="Mobile No." value="{{old('mobile')}}">
                                    </div>
                                </div>


                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <textarea name="notes" id="notes" cols="30" rows="2" placeholder="Order Notes (optional)" class="form-control">{{old('notes')}}</textarea>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div><br/><br/>
                
                <div class="col-md-4">
                    <div class="sub-title">
                        <h2>Order Summery</h3>
                    </div>
                    <div class="card cart-summery">
                        <div class="card-body">
                            @foreach ($cart as $item)
                            <div class="d-flex justify-content-between pb-2">
                                <div class="h5">{{$item->name}} <span class="badge bg-danger">X</span> {{$item->quantity}}</div>
                                <div class="h5 badge bg-light border text-black" style="font-size: 16px;">Rs.{{$item->selling_price*$item ->quantity}}</div>
                            </div>

                            @endforeach


                            <div class="justify-content-between summery-end">
                                <div class="h5">Discount:</div>
                                @php
                                $cartTotal =0;
                                @endphp
                                @foreach($cart as $item)
                                    @php
                                        $total = $item->selling_price * $item->quantity;
                                        $cartTotal += $total
                                    @endphp
                              
                                @endforeach
                              
                                    @if(Session::has('coupon'))
                                  
                                    <span class="badge bg-light border text-black" style="font-size:16px;">{{session()->get('coupon')['discount']}}% ({{$discount = $cartTotal * session()->get('coupon')['discount'] / 100 }} Rs.)</span><br/><br/>
                                    <div class="h5">Discount Price:</div>
                                    <span class="badge bg-light border text-black" style="font-size: 16px;">Rs.{{$cartTotal - $discount}}</span>
                                @else
                                    <span class="badge bg-light border text-black" style="font-size: 16px;">0%</span>
                                    <span class="badge bg-light border text-black" style="font-size: 16px;">Rs.{{$cartTotal}}</span>
                                @endif
                                
                            </div>
                        </div>
                    </div>

                    <div class="card payment-form ">


                        <h3 class="card-title h5 mb-3">Payment Method</h3>
                        <div class="">
                            <input checked type="radio" name="payment_method" value="cod"  id="payment_method_one">
                            <label for="payment_method_one" class="form-check-label">COD</label>
                        </div>

                        <div class="">
                            <input type="radio" name="payment_method" value="cod"  id="payment_method_two">
                            <label for="payment_method_two" class="form-check-label">Stripe</label>
                        </div>
                        <div class="pt-4">
                            <button type="submit" class="btn-dark btn btn-block w-100">Pay Now</button>
                        </div>
                        <div class="card-body p-0 d-none" id="card-payment-form">
                            <div class="mb-3">
                                <label for="card_number" class="mb-2">Card Number</label>
                                <input type="text" name="card_number" id="card_number" placeholder="Valid Card Number" class="form-control">
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="expiry_date" class="mb-2">Expiry Date</label>
                                    <input type="text" name="expiry_date" id="expiry_date" placeholder="MM/YYYY" class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label for="expiry_date" class="mb-2">CVV Code</label>
                                    <input type="text" name="expiry_date" id="expiry_date" placeholder="123" class="form-control">
                                </div>
                            </div>
                            <div class="pt-4">
                                <a href="submit" class="btn-dark btn btn-block w-100">Pay Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>
@endsection
@section('customJs')
<script>
$("#payment_method_one").click(function(){
    if($(this).is(":checked") == true){
        $("#card-payment-form").addClass('d-none');
    }
});

$("#payment_method_two").click(function(){
    if($(this).is(":checked") == true){
        $("#card-payment-form").removeClass('d-none');
    }
});
</script>
@endsection