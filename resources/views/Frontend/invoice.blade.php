<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>

  
   <style>
    /* Table style */
table {
    width: 100%;
    border-collapse: collapse;
}

/* Table header style */
th {
    background-color: #f2f2f2;
    border: 1px solid #ddd;
    padding: 8px;
    text-align: left;
}

/* Table cell style */
td {
    border: 1px solid #ddd;
    padding: 8px;
}

/* Table row hover effect */
tr:hover {
    background-color: #f5f5f5;
}

/* Badge style */
.badge {
    padding: 5px 10px;
    border-radius: 5px;
    font-size: 14px;
}

/* Badge color classes */
.bg-pending {
    background-color: #ffc107; /* Yellow */
    color: #000;
}

.bg-shipped {
    background-color: #17a2b8; /* Blue */
    color: #fff;
}

.bg-delivered {
    background-color: #28a745; /* Green */
    color: #fff;
}

.bg-canceled {
    background-color: #dc3545; /* Red */
    color: #fff;
}

/* Icon style */
i {
    margin-right: 5px;
}

   </style>
</head>

<body>

     <table class="table-no-border">
        <tr>
            <td class="width-70">
                {{-- <img src="{{ public_path('onlinewebtutor.png') }}" alt="" width="150" /> --}}
            </td>
            <td class="width-30">
                <?php
                $invoiceId = rand();
                ?>


                <h2>Invoice ID:{{$invoiceId}}</h2>
            </td>
        </tr>
    </table>

    <div class="margin-top">
        <table class="table-no-border">
            <tr>
                <td class="width-50">
                    <div><strong>To:</strong></div>
                    <div>{{Auth::user()->email}}</div>
                    <div><strong>From:</strong></div>
                    <div>{{ $superadmin->email }}</div>

                </td>
                <td class="width-50">                    
           
                    <div><strong>Email:</strong> {{Auth::user()->email}}</div>
                </td>
            </tr>
        </table>
    </div>
<br/>
     <div>
        <table class="table-bordered">
            <thead>
                <tr>
                    <th class="width-25">
                        <strong>ID</strong>
                    </th>
                    <th class="width-25">
                        <strong>Qty</strong>
                    </th>
                    <th class="width-50">
                        <strong>Product</strong>
                    </th>
                    <th class="width-25">
                        <strong>Price</strong>
                    </th>
                    <th class="width-25">
                        <strong>Total</strong>
                    </th>
                    <th class="width-25">
                        <strong>Status</strong>
                    </th>
                    <th class="width-25">
                        <strong> Expected Delivered Date</strong>
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($groupedOrderItems as $orderId => $items)
                <tbody>
                    
                   
                   
                    @foreach($items as $item)
                    <tr>
                        <th colspan="7">Order ID: {{ $orderId }}</th>
                    </tr>
                     @if($item->status == '1' ||  $item->status == '0')
                        <tr>
                            <td class="width-25">{{$loop->iteration}}</td>
                            <td class="width-25">{{ $item->quantity }}</td>
                            <td class="width-25">{{ $item->name }}</td>
                            <td class="width-25">{{ $item->selling_price }}</td>
                           <td class="width-25">
                            @if(Session::has('coupon'))
                            <span class="badge bg-dark" style="font-size:16px;">{{ session()->get('coupon')['discount'] }}% ({{ $discount = $item->total * session()->get('coupon')['discount'] / 100 }} Rs.)</span><br/><br/>
                            <div class="h5">Discount Price:</div>
                            <span class="badge bg-dark" style="font-size: 16px;">Rs.{{ $item->total - $discount }}</span>
                        @else
                            <span class="badge bg-info" style="font-size:17px;">{{ $item->total }} Rs-/-</span>
                        @endif
                           </td>
                            <td>
                                <span class="badge {{ $item->status == 0 ? 'bg-warning' : ($item->status == '1' ? 'bg-info' : ($item->status == '2' ? 'bg-success' : 'bg-danger')) }}" style="font-size: 17px;">
                                    @if($item->status == '0')
                                       <i class="fas fa-shield-alt"></i> pending
                                    @elseif($item->status == '1')
                                    <i class="fa-solid fa-truck"></i> shipped
                                    @elseif($item->status == '2')
                                        <i class="fas fa-check"></i> Delivered
                                    @else
                                        X Canceled
                                    @endif
                                </span>
                              </td>
                              <td class="width-25">{{ $item->shipped_date}}</td>
                        </tr>
                     @endif   
                    @endforeach
                </tbody>
            @endforeach
            
            </tbody>
          
        </table>
    </div>

    <div class="footer-div">

   
       
        <h2 style="color: rgb(0, 0, 0); background-color: #2193b0; overflow: hidden;">
            <span style="display: inline-block; white-space: nowrap;">
               
                <span style="color: #ddd">Your Order ID:{{ $invoiceId }}
                @if($item->status == 2)
                {{ Auth::user()->name }}Your Order is Delivered Successfully!!
                @else
                Thank you,
                <span style="color: #0707ff; font-weight: bold;">{{ Auth::user()->name }}</span>
                For Your Order!!
                @endif
            </span>
            </span>
        </h2>
        
    </span><br />
    </div>

</body>

</html>
