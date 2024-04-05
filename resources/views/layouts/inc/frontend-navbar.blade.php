<nav class="sb-topnav navbar navbar-expand navbar-dark bg-primary">
    <!-- Navbar Brand-->
    &nbsp;
    <h4 class="text-white">
      @php
      $setting = App\Models\Setting::where('id','1')->first();

      @endphp
      <img src="{{asset('uploads/settings/'.$setting->logo)}}" width="30px" height="27px">
      {{$setting->website_name}}
   
      @if(!Auth::check())
      <a href="{{url('login')}}" class="btn btn-light text-primary"  style="border-radius: 5px;font-weight:bold;">Login</a>
     
      @endif
    </h4>&nbsp;&nbsp;&nbsp;&nbsp;
  
    <!-- Navbar Search-->
    @if(Auth::check())
    <form action="{{url('/search')}}" method="GET"class="ms-auto">
        <div class="input-group">
            <input class="form-control" type="text" name="search" placeholder="Search for..." value="{{isset($search) ? $search : ''}} "aria-describedby="btnNavbarSearch" />
            <button class="btn btn-light" id="btnNavbarSearch" type="submit"><svg width="20" height="20" viewBox="0 0 17 18" class="" xmlns="http://www.w3.org/2000/svg"><g fill="#2874F1" fill-rule="evenodd"><path class="_34RNph" d="m11.618 9.897l4.225 4.212c.092.092.101.232.02.313l-1.465 1.46c-.081.081-.221.072-.314-.02l-4.216-4.203"></path><path class="_34RNph" d="m6.486 10.901c-2.42 0-4.381-1.956-4.381-4.368 0-2.413 1.961-4.369 4.381-4.369 2.42 0 4.381 1.956 4.381 4.369 0 2.413-1.961 4.368-4.381 4.368m0-10.835c-3.582 0-6.486 2.895-6.486 6.467 0 3.572 2.904 6.467 6.486 6.467 3.582 0 6.486-2.895 6.486-6.467 0-3.572-2.904-6.467-6.486-6.467"></path></g></svg></button>
        </div>
    </form>
    @endif
    <!-- Navbar-->
    @if(Auth::check())
    <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-white" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">

             <a class="dropdown-item" href="{{url('profiles')}}">
              Profile</a>
                <a class="dropdown-item" href="{{ route('logout') }}"
                onclick="event.preventDefault();
                              document.getElementById('logout-form').submit();">
                 {{ __('Logout') }}
                </a>
              
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>  
                   
            </ul>
            
        </li>
    </ul>
    @endif

    
</nav>
<div class="global-navbar bg-light" >
    <div class="container" >
       <div class="row">
            <div class="col-md-2 d-none d-md-inline">
               
            </div>
            <div class="col-md-8 my-auto p-2 text-black">
                <div class="border text-center" >
                  @php
                  $setting = App\Models\Setting::find(1);
                @endphp
                <h4 >
                  <img src="{{asset('uploads/settings/'.$setting->logo)}}" width="32px" height="27px">
                {{$setting->website_name}}
   
                </h4>
           
                </div>
                
            </div> 
            <div class="col-md-2 d-none d-md-inline">
            
             
            </div>
          </div>
         
         
       </div>
    </div>
</div>
<div class="sticky-top">
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
          <a href="" class="navbar-brand d-inline d-sm-inline d-md-none">
           
          </a>
          <button class="navbar-toggler text-end" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                
              <li class="nav-item">
                <a class="nav-link active"  style="font-weight: bold" aria-current="page" href="{{url('/Front')}}">Home</a>
              </li>
            
              <li class="nav-item dropdown">
              @if(Auth::check()) 
              @php
               $categories = App\Models\Category::where('navbar_status' ,'1')->where('status', '1')->get(); 
              @endphp
              @foreach($categories as $category)
                <li class="nav-item text-light" style="font-weight: bold">
                    <a class="nav-link active" href="{{url('CategorySlug/' .$category->slug)}}">{{$category->name}}</a>  
                </li>
              @endforeach
              @endif
                


             
            </ul>
            <!-- Navbar Search-->
 
            @if(Auth::check())
            @php
            $total = App\Models\Cart::all()->where('user_id',Auth::user()->id)->where('quantity')->sum(function($t){
             return  $t->selling_price * $t->quantity;
            });
            $totalQuantity = App\Models\Cart::where('user_id', Auth::user()->id)->sum('quantity');
            $wishQuantity = App\Models\Wishlist::where('user_id', Auth::id())->get();
            $orders = App\Models\OrderItem::where('user_id',Auth::user()->id)->latest()->get();
            @endphp
            <ul class="list-inline">
              
              <li class="list-inline-item">
                <a href="{{url('myorders/')}}"  class="text-decoration-none text-white"><i class="	fas fa-shopping-basket" style="font-size: 23px;"></i><span style="position: relative; top: -10px; right: 3px; background-color: #ff4500; color: #fff; border-radius: 50%; padding: 4px 8px; font-size: 12px;">{{count($orders)}}</span></a>
                <a href="{{url('wishlistpage/')}}" style="padding: 10px;text-decoration:none;color:#ffffff;"><i class="fa fa-heart" style="font-size: 23px;"></i><span style="position: relative; top: -10px; right: 3px; background-color: #ff4500; color: #fff; border-radius: 50%; padding: 4px 8px; font-size: 12px;">{{count($wishQuantity)}}</span></a>
                <a href="{{url('cartPage/')}}" style="position: relative; display: inline-block; padding: 10px; text-decoration: none; color: #ffffff;">
                    <i class="fa fa-shopping-cart" style="font-size: 24px;"></i>
                    <span style="position: absolute; top: 0; right: 0; background-color: #ff4500; color: #fff; border-radius: 50%; padding: 4px 8px; font-size: 12px;">{{$totalQuantity}}</span>
                </a>
            </li>
       
            
            </ul>
              <p class="text-light">
                <a class="nav-link active text-white list-inline-item"> <span style="font-size: 20px;"> Cart Total:</span>&nbsp;<span class="badge bg-light px-3 py-2" style="font-size: 17px;color:black">{{$total}}</span></a>  
              </p>
            @endif
          </div>
        </div>
    </nav>
</div>
   
