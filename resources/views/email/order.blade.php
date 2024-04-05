<!DOCTYPE html>
<html>

<head>
    <title>

    </title>
    @php
        $setting = App\Models\Setting::find(1);
    @endphp
    @if ($setting)
        <link rel="shortcut icon" href="{{ asset('uploads/settings/' . $setting->favicon) }}" type="image/x-icon">
    @endif

    <style>
        /* Define your CSS styles here */
        .container {
            margin: 20px auto;
            width: 80%;
        }

        .card {
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .card-body {
            padding: 20px;
        }

        .table {
            width: 30%;
            border-collapse: collapse;
        }

        .table th,
        .table td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .table th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        .table img {
            max-width: 50px;
            border-radius: 5px;
        }

        #payment-mode {
            font-weight: bold;
        }
    </style>
</head>

<body>

    <div class="card">
        <div class="card-body">

            @foreach ($orders as $order)
                <table class="table table-bordered table-group-divider table-striped" style="font-size: 20px;margin-left:40%;">
                    <tbody>
                        @php
                            $productImages = $order->products->productImages;
                        @endphp

                        <tr>
                            <th>Product Image:</th>
                            <td>
                                @if ($productImages->isNotEmpty())
                                    <img class="card-img-top" src="{{ asset($productImages->first()->image) }}"
                                        style="width: 30%;border-radius:3px;">
                                @else
                                    <span>No Image Available</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Name:</th>
                            <td><span
                                    class="badge {{ $order->status == 0 ? 'bg-warning' : ($order->status == '1' ? 'bg-info' : ($orderItm->status == '2' ? 'bg-success' : 'bg-danger')) }}">{{ $order->name }}</span>
                            </td>
                        </tr>
                        <tr>
                            <th>Email:</th>
                            <td>{{ Auth::user()->email }}</td>
                        </tr>
                        <tr>
                            <th>Quantity:</th>
                            <td>{{ $order->quantity }}</td>
                        </tr>
                        <tr>
                            <th>Selling_price:</th>
                            <td><span class="badge bg-dark">Rs.{{ $order->selling_price }}</span></td>
                        </tr>
                        <tr>
                            <th>Total:</th>
                            <td><span class="badge bg-dark">Rs.{{ $order->total }}</span></td>
                        </tr>
                        <div id="selected-payment-mode">

                            <tr>
                                <th>Payment Mode:</th>
                                <td><span id="payment-mode"></span></td>
                            </tr>

                        </div>
                        <script>
                            $(document).ready(function() {
                                // Event handler for payment method selection
                                $("input[name='payment_method']").change(function() {
                                    var selectedPaymentMode = $("input[name='payment_method']:checked").val();

                                    // Hide or show the card payment form based on the selected payment method
                                    if (selectedPaymentMode == 'cod') {
                                        $("#card-payment-form").addClass('d-none');
                                    } else {
                                        $("#card-payment-form").removeClass('d-none');
                                    }

                                    // Update the selected payment mode in the table
                                    $("#payment-mode").text(selectedPaymentMode.toUpperCase());
                                });
                            });
                        </script>



                    </tbody>

                </table>
                <div
                        style="position: relative; padding: 50px; border: 5px solid transparent; border-radius: 10px; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2); animation: borderAnimation 2s linear infinite; text-align: center;">
                        <span
                            style="background: linear-gradient(45deg, #2193b0, #6dd5ed, #ff9a8b, #ff6a88, #ff99ac, #f6d365, #fda085, black); background-size: 200% 200%; -webkit-text-fill-color: transparent; -webkit-background-clip: text; animation: gradientEffect 5s ease-in-out infinite; font-size: 2em; display: block;">
                            👍 {{ Auth::user()->name }}, Thank You For Connecting With Us!! 👍<br />
                            👍 Your Order Placed Sucessfully!!👍<br />
                            <a href="{{ url('Front/') }}">💁Return To Home💁</a><br />
                        </span>
                    </div>
            @endforeach

        </div>
    </div>

</body>


</html>