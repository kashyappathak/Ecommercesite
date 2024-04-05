<?php

namespace App\Http\Controllers\Admin;
use App\Models\Order;
use App\Models\Country;
use App\Http\Controllers\Controller;
use App\Models\OrderItem;
use App\Models\Cart;
use Database\Seeders\CountrySeeder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;


class OrderController extends Controller
{
    public function index(){
        if (Auth::user()->role_as == 1 ) {
            $orders = OrderItem::with('user')->latest()->get();
            $orderitem = Order::with('user')->latest()->get();
        } else {

            $orders = OrderItem::where('user_id', Auth::user()->id)->latest()->get();
            $orderitem = Order::where('user_id', Auth::user()->id)->latest()->get();
        }
        
        return view('admin.orders.index', compact('orders','orderitem'));
    }

    public function edit($id){
       
        $countries = Country::pluck('id','name');
        $order = OrderItem::find($id);

        if (Auth::user()->role_as == 1  || Auth::user()->role_as == '0') {
            $orderItems = OrderItem::where('id', $order->id)->latest()->get();
            $Myorders = Order::where('id', $order->order_id)->latest()->get();

        } else {

            $orderItems = OrderItem::where('user_id', Auth::user()->id)->latest()->get();
            $Myorders = Order::where('user_id',Auth::user()->id)->latest()->get();
        }
        
        return view('admin.orders.edit', compact('Myorders','order','orderItems','countries'));
    }


    public function update(Request $request , $id)
    {
        $order = OrderItem::find($id);
        if($order){
            $order->name = $request->name;
            $order->status = $request->status;
            $order->shipped_date = date('Y-m-d H:i:s', strtotime($request->shipped_date));
            $order->update();
            return redirect()->route('orders.index')->with('message','Order Status Updated Successfully✔✔');
        }else{
            return redirect()->route('orders.index')->with('message','Order Not Found🥵🥵');

        }
    }

    public function destroy($order_id) {
        $order = OrderItem::find($order_id);
        
        if ($order) {
            $order->delete();
            return redirect()->back()->with('message', 'Order Deleted Successfully!');
        } else {
            return redirect()->back()->with('error', 'Order not found!');
        }
    }

    public function delete($id) {
        $orderItem = Order::find($id);
        
        if ($orderItem) {
            $orderItem->delete();
            return redirect()->route('orders.index')->with('message', 'Order Item Deleted Successfully!');
        } else {
            return redirect()->back()->with('error', 'Order Item not found!');
        }
    }
    
}
