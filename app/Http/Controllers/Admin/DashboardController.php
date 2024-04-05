<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use App\Models\Cart;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Comment;
use App\Models\Setting;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $category = Category::count();
        $activecategory = Category::where('status' , '1')->count();
        $inactivecategory = Category::where('status' ,'0')->count();
        $activeproduct = Product::where('status' , '1')->count();
        $inactiveproduct = Product::where('status','0')->count();
        $trandingproduct = Product::where('trending' , '1')->count();
        $products = Product::count();
        $brands = Brand::count();
        $user = User::count();
        $cart = Cart::count();
        $orders = OrderItem::count();
        $orderItem = OrderItem::count();
        $coupon  = Coupon::count();
        $Active = Coupon::where('status',1)->count();
        $InActive = Coupon::where('status',0)->count();
        $comment = Comment::with('products')->count();
        $role = User::where('role_as','1')->count();
        $employee = User::where('role_as','0')->count();
        $customer = User::where('role_as','2')->count();
        $setting = Setting::where('id','1')->count();
        $totalwishlist = Wishlist::count();
        $wishlist = Wishlist::where('user_id', Auth::user()->id)->count();
        $deliveredorder = OrderItem::where('status' , '2')->count();
        $pendingorder = OrderItem::where('status' , '0')->count();
        $shippedorder = OrderItem::where('status' , '1')->count();
        $canceledorder = OrderItem::where('status' , '3')->count();
        $deliveredorderemp = OrderItem::where('status' , '2')->where('user_id',Auth::user()->id)->count();
        $pendingorderemp = OrderItem::where('status' , '0')->where('user_id',Auth::user()->id)->count();
        $shippedorderemp = OrderItem::where('status' , '1')->where('user_id',Auth::user()->id)->count();
        $canceledorderemp = OrderItem::where('status' , '3')->where('user_id',Auth::user()->id)->count();
        return view('admin.dashboard', compact('category','products','user','brands','cart','orders','orderItem','Active','InActive','coupon','comment','role','employee','customer','setting','totalwishlist','wishlist','deliveredorder','pendingorder','shippedorder','canceledorder','deliveredorderemp','pendingorderemp','shippedorderemp','canceledorderemp','activecategory','inactivecategory','activeproduct', 'inactiveproduct','trandingproduct'));
    }

    public function search(Request $request){

        $search = $request->search;        
        if($search){
            $categories = Category::where('name', 'like', "%$search%")->get(); // Add get() to execute the query and retrieve the results
            $products = Product::where('name', 'like', "%$search%")->orWhere('meta_title', 'like', "%$search%")->get(); 
            $users = User::where('name' , 'like' , "%$search%")->orWhere('email' , 'like' , "%$search%")->get();
            $brands = Brand::where('name', 'like', "%$search%")->get();
            $coupons = Coupon::where('coupon_name', 'like', "%$search%")->get();
            $carts = Cart::where('quantity' , "like" , "%$search%")->get();
            $wishlists = Wishlist::where('product_id' , "like" , "%$search%")->orWhere('user_id' , "like" , "%$search%")->get();
            $orderItem = OrderItem::where('quantity' , "like" , "%$search%")->get();
            $comments = Comment::where('comment' , "like" , "%$search%")->get();
            $searchResults = [
                'categories' => $categories,
                'products' => $products,
                'brands'=>$brands,
                'users'=>$users,
                'coupons'=>$coupons,
                'carts'=>$carts,
                'wishlists'=>$wishlists,
                'orderItem'=>$orderItem,
                'comments'=>$comments,
    
            ];
            return view('admin.search_results', compact('searchResults', 'search'));     
        }else{
            return redirect()->route('dashboard.index')->with('message', 'Following Search is Not Found!!');     
        }
    }
 
}