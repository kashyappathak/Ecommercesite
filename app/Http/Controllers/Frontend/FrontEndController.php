<?php

namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Brand;
use App\Models\Cart;
use App\Models\Coupon;
use App\Models\Wishlist;
use App\Models\Country;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Comment;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\Setting;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;


class FrontEndController extends Controller
{
    public function index(){
        $setting = Setting::find(1);
        $brands = Brand::where('status','1')->get();
        $categories = Category::where('status','1')->get();
        $products = Product::where('status','1')->orderBy('selling_price','ASC')->get();
        $uniqueSellingPrices = $products->pluck('selling_price')->unique()->sort()->values()->all();
        $latestProducts = Product::where('status','1')->orderBy('id','DESC')->get();
        return view('Frontend.index', compact('brands','categories','latestProducts','products','uniqueSellingPrices','setting')); 
    }
    //Product with Category Page
    public function CategorySlug(string $slug){
        $categories = Category::where('slug',$slug)->where('status','1')->first();
        if($categories){
            $products = Product::where('category_id',$categories->id)->where('status','1')->paginate(1);
            $rel_product = Product::where('category_id',$categories->id)->latest()->get();
            return view('frontend.products.index', compact('products','categories','rel_product'));
        }
    }
    //Product Details Page
    public function ProductSlug(string $slug , string $p_slug){
        $categories = Category::where('slug',$slug)->where('status','1')->first();
       
        if($categories){
            $products = Product::where('category_id',$categories->id)->where('slug',$p_slug)->where('status','1')->get();
            $rel_product = Product::where('category_id',$categories->id)->latest()->get();
            $orders = Order::latest()->get();
            $orderItem = OrderItem::latest()->get();
            return view('frontend.products.view', compact('categories','products','rel_product','orders','orderItem'));            
        }
    }
    
    // search button
    public function search(Request $request)
    {
        $search = $request->search;
    
        // Search for categories
        $categories = Category::where('name', 'like', "%$search%")
                              ->orWhere('id', 'like', "%$search%")
                              ->get();
    
        // Search for products
        $products = Product::where('name', 'like', "%$search%")
                           ->orWhere('id', 'like', "%$search%")
                           ->get();
    
        // Get all brands
        $brands = Brand::where('name', 'like', "%$search%")
        ->orWhere('id', 'like', "%$search%")
        ->get(); // Replace 'Brand' with your actual brand model
        $uniqueSellingPrices = $products->pluck('selling_price')->unique()->sort()->values()->all();
        $latestProducts = Product::where('name', 'like', "%$search%")
        ->orWhere('id', 'like', "%$search%")->orderBy('id','DESC')->get();
        return view('frontend.index', compact('categories', 'products', 'search', 'brands','uniqueSellingPrices','latestProducts'));
    }
    
    //Cart add, update,delete

    public function addcart(Request $request, $id)
    {
        if (Auth::check()) {
            $product = Product::find($id);
    
            if (!$product) {
                return response()->json([
                    'status' => false,
                    'message' => 'Product not found!',
                ]);
            }
    
            $existingCart = Cart::where('user_id', Auth::user()->id)->where('product_id', $product->id)->first();
    
            if (isset($existingCart)) {
               return redirect()->back()->with('message','Cart Already Added!!');
            }
            $requestedQuantity = $request->input('quantity', 1);

            if ($requestedQuantity > $product->quantity) {
                return redirect()->back()->with('error', 'Requested quantity is out of stock!');
            }

            $user  = Auth::user();
            $cart = new Cart;
            $cart->user_id = $user->id;
            $cart->product_id = $product->id;
            $cart->name = $product->name;
            $cart->selling_price = $product->selling_price;
            $cart->quantity = $requestedQuantity;
            $cart->save();
    
            if (!$cart) {
                return response()->json([
                    'status' => false,
                    'message' => 'Failed to add item to the cart',
                ]);
            }
            

           return redirect()->back()->with('success','Cart Added Successfully!!');
        } else {
            return redirect('login')->with('error',' Please First Login');
        }
    }

    public function cartPage(){
        $cart = Cart::where('user_id',Auth::user()->id)->latest()->get();
        return view('frontend.products.cart', compact('cart'));
    }

    public function updateCart(Request $request)
    {
        $id = $request->id;
        $quantity = $request->quantity;

        $cart = Cart::find($id);

        // Assuming Product is the related model for the product in the cart
        $product = $cart->products;

        // // // Check if the requested quantity is greater than the available stock
        // if ($quantity >= $product->quantity) {
        //     $message = 'Quantity exceeds available stock.';

        //     return response()->json([
        //         'status' => false,
        //         'message' => $message
        //     ]);
            
        // }

        $requestedQuantity = $request->input('quantity', 1);

        if ($requestedQuantity > $product->quantity) {
            $message = 'Quantiy Exceed Is Out Of Stock!!';

        session()->flash('error', $message);

        return response()->json([
            'status' => true,
            'message' => $message
        ]);
        }
        // Assuming Cart is an instance of the Cart model
        $cart = Cart::find($id);
        $cart->quantity = $quantity;
        $cart->save();

        $message = 'Cart Quantity Updated Successfully!!';

        session()->flash('success', $message);

        return response()->json([
            'status' => true,
            'message' => $message
        ]);
    }

    public function removeCart(Request $request)
    {
        $cart = $request->id;

        $cart = Cart::find($cart);
        $cart->delete();

        $message = 'Cart Removed Successfully!!';

        return redirect()->back()->with('success', $message);    
    }



    //Wishlist
    public function addtowishlist($product_id){
        if(Auth::check()){
            Wishlist::insert([
                'user_id' => Auth::id(),
                'product_id'=> $product_id,

            ]);

            return redirect()->back()->with('success','Product Added On Wishlist');
        }else{
            return redirect()->route('login')->with('error', 'First You Need To Login Your Account!!');
        }
    }

    public function wishlistpage(){
        $wishlists = Wishlist::where('user_id', Auth::id())->latest()->get();
        return view('frontend.products.wishlist', compact('wishlists'));
    }
    
    public function removeWishlist($id)
    {
        Wishlist::where('id', $id)->where('user_id', Auth::id())->delete();
        return redirect()->back()->with('success', 'Wishlist Product is Removed!!');
    }



    //Checkout
    public function checkout(){

        if(Auth::check()){
            $cart = Cart::where('user_id', Auth::user()->id)->latest()->get();
            $countries = Country::all();
         
            return view('frontend.products.checkout',[
                'countries'=> $countries,
                'cart'=> $cart,
              
            ]);
        }else{
            return redirect('login')->with('warning','Pleast Login First👈');
        }
       
    }
    //Order Checkout
    public function processCheckout(Request $request){
        Validator::make($request->all(),[
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'mobile' => 'required',
            'country_id' => 'required',
            'address' => 'required',
            'apartment' => 'required',
            'city' => 'required',
            'state' => 'required',
            'zip' => 'required',
            'notes'=>''
        ])->validated();
      
        $user  = Auth::user();
        $order = new Order;
        $order->user_id = $user->id;
        $order->first_name = $request->first_name;
        $order->last_name = $request->last_name;
        $order->email = $request->email;
        $order->mobile = $request->mobile;
        $order->country_id = $request->country;
        $order->address = $request->address;
        $order->apartment = $request->apartment;
        $order->city = $request->city;
        $order->state = $request->state;
        $order->zip = $request->zip;
        $order->notes = $request->notes;
        $order->save();

        if ($request->payment_method == 'cod') {
            $user = auth()->user();
            $cart = Cart::where('user_id', $user->id)->get();
            foreach ($cart as $cartItem) {
                $orderItem = new OrderItem;
                $orderItem->user_id = $user->id;
                $orderItem->order_id = $order->id; 
                $orderItem->product_id = $cartItem->product_id;
                $orderItem->name = $cartItem->name;
                $orderItem->quantity = $cartItem->quantity;
                $orderItem->selling_price = $cartItem->selling_price;
                $orderItem->total = $cartItem->quantity * $cartItem->selling_price;
                $orderItem->save();
            }
            $message = 'Order Placed Successfully!!!';
            return redirect('thanks/'.$order->id)->with('success',$message);
        }else{
            $message = 'Order Item Not Found';

            session()->flash('error', $message);

            return response()->json([
                'status' => true,
                'message' => $message
            ]);
        }
        

    }

    public function thankyou(){
        return view('frontend.thanks');
    }

    // Coupon 
    public function applyCoupon(Request $request){
       $coupon = Coupon::where('coupon_name', $request->coupon_name)->first();
       $validator = Validator::make($request->all(), [
        'coupon_name' => 'required|string',
    ]);
    
    if ($validator->fails()) {
        // If validation fails, you can set a session error message
        session()->flash('error', 'Coupon name field is required!!');
        return redirect()->back()->withErrors($validator)->withInput();
    }
    
        if($coupon) {
            if($coupon->status == 1) {
                Session::put('coupon',[
                    'coupon_name' => $coupon->coupon_name,
                    'discount' => $coupon->discount,
                ]);
                return redirect()->back()->with('success', 'Coupon Applied Successfully');
            } else if($coupon->status == 0) {
                return redirect()->back()->with('error', 'Applied Coupon is Inactive!');
            } else {
                return redirect()->back()->with('error', 'Applied Coupon is Invalid!');
            }
        } else {
            return redirect()->back()->with('error', 'Coupon not found!');
        }
        
    }

    public function destroyCoupen(){
        if(Session::has('coupon')){
            session()->forget('coupon');

            return redirect()->back()->with('success', 'Coupen is Removed Successfully!');
        }
    }


    public function orderCancel($id){
        $updatedRows = OrderItem::where('id', $id)->update(['status' => 3]); // Assuming 'Canceled' corresponds to status code 3
        
        if ($updatedRows > 0) {
            $order = OrderItem::find($id);

            return redirect()->back()->with('success', 'Order with ID ' . $order->id . '  has been Cancelled Successfully!!');
        } else {
            
            return redirect()->back()->with('error', 'Unable to cancel order. Invalid order ID.');
        }
    }
    
    

    // Comment Area
    public function store(Request $request){
   
        if(Auth::check()){

            $validator = Validator::make($request->all(), [
                'image'=>'required',
                'comment'=>'required'
            ]);
            
            if ($validator->fails()) {
                // If validation fails, you can set a session error message
                session()->flash('error', 'please fill all the details!!');
                return redirect()->back()->withErrors($validator)->withInput();
            }
        
                
            $products = Product::where('slug', $request->p_slug)->where('status', '1')->get();
            if ($products->isNotEmpty()) {
                foreach ($products as $product) {
                    $comment = new Comment;
                    $comment->product_id = $product->id; 
                    $comment->user_id = Auth::user()->id;
                    $comment->comment = $request->comment;
            
                    if ($request->hasFile('image')) {
                        $file = $request->file('image');
                        $filename = time() . '.' . $file->getClientOriginalExtension();
                        $file->move('uploads/comment', $filename);
                        $comment->image = 'uploads/comment/' . $filename;
                    }
            
                    $comment->save();
                    
                   return redirect()->back()->with('success','Commented Successfully!!');
                }
            }else{
            return redirect()->back()->with('error','Comment Not Found!!');
            }

          
        }else{
            return redirect('login')->with('warning','First You Need To Login');

        }
    }

    public function edit($id){
        $comment = Comment::find($id);

        return view('Frontend.products.commentedit',compact('comment'));
    }

    public function update(Request $request , $id){
        if (Auth::check()) {
            $comment = Comment::find($id);
    
            if ($comment) {
                $comment->comment = $request->comment;
                $comment->update();
    
                return redirect()->back()->with('success', 'Comment updated successfully!!');
             

            } else {
                return redirect()->back()->with('error', 'No such comment found👈');
            }
        } else {
            return redirect('login')->with('warning', 'First, you need to log in');
        }
    }

    public function destroy($id){
      if(Auth::check()){
        $comment  = Comment::find($id);
        if($comment){
        
            $comment->delete();
            return redirect()->back()->with('success', 'Comment Removed Successfully!!' );
        }else{
            return redirect()->back()->with('error', 'Something Went Wrong' );
        }

      }else{
        return redirect('login')->with('warning', 'First,you need to login' );
      }

    }

    //profiles 
    public function profiles(){
        $orders = OrderItem::where('user_id', Auth::user()->id)->latest()->get();
        return view('Frontend.profile', compact('orders'));
    }

    public function profilesupdate(Request $request){
        $user = Auth::user();
        $user->name = $request->name;
        $user->email = $request->email;
    
        if (!empty($request->password)) {
            $user->password = Hash::make($request->password);
        }
        $user->save();
    
        return redirect('profiles')->with('success', 'Profile updated successfully');
    }

    public function myorders(){
        
        $orderItem = OrderItem::where('user_id',Auth::user()->id)->latest()->get();
        $orders = Order::where('user_id',Auth::user()->id)->latest()->get();
        return view('Frontend.myorders', compact('orderItem', 'orders'));
    }


    public function view($id){
        $order = OrderItem::find($id);

        if (Auth::user()->role_as == 1  || Auth::user()->role_as == '0') {
            $orderItems = OrderItem::where('id', $order->id)->latest()->get();
            $Myorders = Order::where('id', $order->order_id)->latest()->get();

        } else {

            $orderItems = OrderItem::where('user_id', Auth::user()->id)->latest()->get();
            $Myorders = Order::where('user_id',Auth::user()->id)->latest()->get();
        }
        return view('Frontend.view', compact('orderItems', 'Myorders','order'));
    }
}
