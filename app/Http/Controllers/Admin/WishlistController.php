<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function index(){
        if (Auth::user()->role_as == 1 ) {
            $wishlists = Wishlist::with('user')->latest()->get();
        } else {

            $wishlists = Wishlist::where('user_id', Auth::user()->id)->latest()->get();
       
        }

        return view('admin.wishlists.index', compact('wishlists'));

    }
    public function searchwishlist(Request $request){
        $search = $request->search;

        $wishlists = Wishlist::Where('user_id', 'like', "%$search%")->orWhere('product_id' , 'like' , "%$search%")->get();
        
    return view('admin.wishlists.index', compact('wishlists', 'search'));
    }
}
