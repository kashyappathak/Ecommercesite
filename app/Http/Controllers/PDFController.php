<?php

namespace App\Http\Controllers;

use PDF;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;
use App\Models\OrderItem;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Mail\OrderEmail;

use App\Models\Setting;

class PDFController extends Controller
{
        public function index()
        {

            $setting = Setting::find(1);


            $orders = OrderItem::where('user_id', Auth::user()->id)->latest()->get();
            $order = Order::where('user_id', Auth::user()->id)->latest()->first(); // Assuming $order represents a single order

            // Check if the user has an email address
            if ($order && $order->email) {

                Mail::to($order->email)->send(new OrderEmail($orders));
            } else {

            }
            return view('email.order', compact('orders','setting'))->with('message', 'Order Placed Successfully');
        }
}