<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index(){
        if (Auth::user()->role_as == 1 ) {
            $carts = Cart::with('user')->latest()->get();
        } else {

            $carts = Cart::where('user_id', Auth::user()->id)->latest()->get();
       
        }
        
        return view('admin.carts.index', compact('carts'));
    }


    public function edit($id){
       
       
        $cart = Cart::findOrFail($id);
        
        return view('admin.carts.edit', compact('cart'));
    }

    public function update(Request $request , $id)
    {
        $cart = Cart::find($id);
        if($cart){
            $cart->name = $request->name;
            $cart->selling_price = $request->selling_price;
            $cart->quantity = $request->quantity;
            $cart->update();
            return redirect()->route('carts.index')->with('message','Cart Updated Successfully✔✔');
        }else{
            return redirect()->route('carts.index')->with('message','Cart Not Found🥵🥵');

        }
    }

    public function destroy($id){
        $cart = Cart::find($id);
        $cart->delete();
        return redirect()->route('carts.index')->with('message' , 'Cart removed Successfully!!');
    }
}
