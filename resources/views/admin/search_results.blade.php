@extends('layouts.master')

@section('content')

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br/><div class="row">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br/>
    <div class="col-md-6">
        <div class="card">
            &nbsp;
            <h2 class="text-center">Search Details</h2>
         
        </div>
    </div>
</div>

@foreach($searchResults['categories'] as $category)
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br/><div class="row">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br/>
    <div class="col-md-6">
        <div class="card">
            &nbsp;
            <h2>Searched Category</h2>
            <div class="card-body">

                <table class="table table-bordered">
                    <tr>
                        <th>#</th>
                        <th>Category Image</th>
                        <th>Category Name</th>
                        <th>Category Status</th>
                    </tr>
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        @if($category->image)
                        <td><img src="{{asset($category->image)}}" width="40px"></td>
                        @endif
                        <td>{{$category->name}}</td>
                        <td class="badge {{$category->status == '1' ? 'bg-success':'bg-danger'}}">{{$category->status == '1' ?'Active':'Inactive'}}</td>
                       
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
@endforeach


@foreach($searchResults['products'] as $product)

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br/><div class="row">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br/>
    <div class="col-md-6">
        <div class="card">
            <h2>Searched Products</h2>
            <div class="card-body">

                <table class="table table-bordered">
                    <tr>
                        <th>#</th>
                        <th>Product Name</th>
                        <th>Product Price</th>
                        <th>Product Status</th>
                    </tr>
                    <tr>
                        <td>{{$loop->iteration}}</td>
                      
                        <td>{{$product->name}}</td>
                        <td>{{$product->selling_price}}</td>
                        <td class="badge {{$product->status == '1' ? 'bg-success':'bg-danger'}}">{{$product->status == '1' ?'Active':'Inactive'}}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
@endforeach



@foreach($searchResults['brands'] as $brand)

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br/><div class="row">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br/>
    <div class="col-md-6">
        <div class="card">
            <h2>Searched Brands</h2>
            <div class="card-body">

                <table class="table table-bordered">
                    <tr>
                        <th>#</th>
                        <th>brand Name</th>
                        <th>brand Status</th>
                    </tr>
                    <tr>
                        <td>{{$loop->iteration}}</td>
                      
                        <td>{{$brand->name}}</td>
                        <td class="badge {{$brand->status == '1' ? 'bg-success':'bg-danger'}}">{{$brand->status == '1' ?'Active':'Inactive'}}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
@endforeach


@foreach($searchResults['users'] as $user)

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br/><div class="row">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br/>
    <div class="col-md-6">
        <div class="card">
            <h2>Searched User</h2>
            <div class="card-body">

                <table class="table table-bordered">
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        {{$user->name}}
                        {{$user->email}}
                        {{$user->role_as == '1' ? 'SuperAdmin' : ($user->role_as == '0' ? 'Employee' : 'Customer')}}
                       
                       
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>

@endforeach


@foreach($searchResults['coupons'] as $coupon)

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br/><div class="row">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br/>
    <div class="col-md-6">
        <div class="card">
            <h2>Searched coupon</h2>
            <div class="card-body">

                <table class="table table-bordered">
                    <tr>
                        <th>#</th>
                        <th>coupon Name</th>
                        <th>coupon Discount</th>
                        <th>coupon Status</th>
                    </tr>
                    <tr>
                        <td>{{$loop->iteration}}</td>
                      
                        <td>{{$coupon->coupon_name}}</td>
                        <td>{{$coupon->discount}}</td>
                        <td class="badge {{$coupon->status == '1' ? 'bg-success':'bg-danger'}}">{{$coupon->status == '1' ?'Active':'Inactive'}}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
@endforeach




@foreach($searchResults['carts'] as $cart)

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br/><div class="row">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br/>
    <div class="col-md-6">
        <div class="card">
            <h2>Searched Cart</h2>
            <div class="card-body">

                <table class="table table-bordered">
                    <tr>
                        <th>#</th>
                        <th>Role User</th>
                        <th>Cart Name</th>
                        <th>Cart Quantity</th>
                        <th>Cart selling_price</th>
                    </tr>
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
                        <td>{{$cart->name}}</td>
                        <td>{{$cart->quantity}}</td>
                        <td>{{$cart->selling_price}}</td>

                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
@endforeach




@foreach($searchResults['wishlists'] as $wishlist)

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br/><div class="row">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br/>
    <div class="col-md-6">
        <div class="card">
            <h2>Searched Wishlist item</h2>
            <div class="card-body">

                <table class="table table-bordered">
                    <tr>
                        <th>#</th>
                        <th>User Role</th>
                        <th>Wishlist Name</th>
                        <th>Wishlist Quantity</th>
                        <th>Wishlist selling_price</th>
                    </tr>
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td style="font-size: 20px;">
                            @if(Auth::user()->role_as == 1 || Auth::user()->role_as =='0')
                            @if($wishlist->user)
                                @if($wishlist->user->role_as == 1)
                                    <span class="badge bg-success"><i class="fas fa-crown"></i> SuperAdmin</span>
                                @elseif($wishlist->user->role_as == 0)
                                    <span class="badge bg-primary"><i class="fas fa-user-tie"></i> Employee</span>
                                @else
                                    <span class="badge bg-danger"><i class="fas fa-user"></i> Customer</span>
                                @endif
                            @endif
                        @endif
                        </td>
                        <td>{{ $wishlist->products->name }}</td>
                        <td>{{ $wishlist->products->quantity }}</td>
                        <td>{{ $wishlist->products->selling_price }}</td>

                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
@endforeach



@foreach($searchResults['orderItem'] as $orderItems)

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br/><div class="row">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br/>
    <div class="col-md-6">
        <div class="card">
            <h2>Searched Orders</h2>
            <div class="card-body">

                <table class="table table-bordered">
                    <tr>
                        <th>#</th>
                        <th>Order Roles</th>
                        <th>Order Name</th>
                        <th>Order Quantity</th>
                        <th>Order selling_price</th>
                    </tr>
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td style="font-size: 20px;">
                            @if(Auth::user()->role_as == 1 || Auth::user()->role_as =='0')
                            @if($orderItems->user)
                                @if($orderItems->user->role_as == 1)
                                    <span class="badge bg-success"><i class="fas fa-crown"></i> SuperAdmin</span>
                                @elseif($orderItems->user->role_as == 0)
                                    <span class="badge bg-primary"><i class="fas fa-user-tie"></i> Employee</span>
                                @else
                                    <span class="badge bg-danger"><i class="fas fa-user"></i> Customer</span>
                                @endif
                            @endif
                        @endif
                        </td>
                        <td>{{$orderItems->name}}</td>
                        <td>{{$orderItems->quantity}}</td>
                        <td>{{$orderItems->selling_price}}</td>

                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
@endforeach




@foreach($searchResults['comments'] as $comment)

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br/><div class="row">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br/>
    <div class="col-md-6">
        <div class="card">
            <h2>Searched Comment</h2>
            <div class="card-body">
                <table class="table table-bordered">
                    <tr>
                        <th>#</th>
                        <th>Comment Roles</th>
                        <th>Comment</th>
                        <th>Commented User</th>                      
                    </tr>
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td style="font-size: 20px;">
                            @if(Auth::user()->role_as == 1 || Auth::user()->role_as =='0')
                            @if($comment->user)
                                @if($comment->user->role_as == 1)
                                    <span class="badge bg-success"><i class="fas fa-crown"></i> SuperAdmin</span>
                                @elseif($comment->user->role_as == 0)
                                    <span class="badge bg-primary"><i class="fas fa-user-tie"></i> Employee</span>
                                @else
                                    <span class="badge bg-danger"><i class="fas fa-user"></i> Customer</span>
                                @endif
                            @endif
                        @endif
                        </td>
                        <td>{{$comment->comment}}</td>
                        <td>{{$comment->user->name}}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>



@endforeach
@endsection