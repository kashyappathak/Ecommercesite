<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <br/>
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading">Core</div>
                <a class="nav-link" href="{{url('admin/dashboard')}}">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Dashboard
                </a>
                <div class="sb-sidenav-menu-heading">Interface</div>
                @if(Auth::user()->role_as == '1' || Auth::user()->role_as == '0')
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayout4" aria-expanded="false" aria-controls="collapseLayout4">
                    <div class="sb-nav-link-icon"><i class="fas fa-user-alt"></i></div>
                    Users
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseLayout4" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        
                        <a class="nav-link" href="{{route('users.index')}}">View Users</a>
                    </nav>
                </div>
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayout" aria-expanded="false" aria-controls="collapseLayout">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-file-circle-plus"></i></div>
                    Category
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseLayout" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        
                        <a class="nav-link" href="{{route('categories.index')}}">View Category</a>
                    </nav>
                </div>
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages1" aria-expanded="false" aria-controls="collapsePages1">
                    <div class="sb-nav-link-icon"><i class='fab fa-bimobject' style='font-size:18px'></i></div>
                    Brands
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapsePages1" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        
                        <a class="nav-link" href="{{route('brands.index')}}">View Brands</a>
                    </nav>
                </div>
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages2" aria-expanded="false" aria-controls="collapsePages2">
                    <div class="sb-nav-link-icon"><i class='fas fa-cart-arrow-down' style='font-size:18px'></i></div>
                    Products
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapsePages2" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        
                        <a class="nav-link" href="{{route('products.index')}}">View Products</a>
                    </nav>
                </div>

                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages5" aria-expanded="false" aria-controls="collapsePages5">
                    <div class="sb-nav-link-icon"><i class="fa fa-gift" aria-hidden="true" style="font-size: 20px;"></i></div>
                    Coupens
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapsePages5" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        
                        <a class="nav-link" href="{{route('coupons.index')}}">View Coupens</a>
                    </nav>
                </div>

                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages3" aria-expanded="false" aria-controls="collapsePages3">
                    <div class="sb-nav-link-icon"><i class='fas fa-shopping-basket' style='font-size:18px'></i></div>
                    Orders
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapsePages3" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        
                        <a class="nav-link" href="{{route('orders.index')}}">View Orders</a>
                    </nav>
                </div>
                @if(Auth::user()->role_as == '1')
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages9" aria-expanded="false" aria-controls="collapsePages9">
                    <div class="sb-nav-link-icon"><i class='fa fa-gear fa-spin' style='font-size:18px'></i></div>
                    Settings
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
        
                <div class="collapse" id="collapsePages9" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">                   
                        <a class="nav-link" href="{{url('admin/settings')}}">Setting</a>
                    </nav>
                </div>
                @endif
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages10" aria-expanded="false" aria-controls="collapsePages10">
                    <div class="sb-nav-link-icon"><i class='fas fa-shopping-cart' style='font-size:18px'></i></div>
                    Carts
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapsePages10" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        
                        <a class="nav-link" href="{{route('carts.index')}}">View Cart</a>
                    </nav>
                </div>
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages11" aria-expanded="false" aria-controls="collapsePages11">
                    <div class="sb-nav-link-icon"><i class='fas fa-heart' style='font-size:18px'></i></div>
                    Wishlists
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapsePages11" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        
                        <a class="nav-link" href="{{route('wishlists.index')}}">View Wishlists</a>
                    </nav>
                </div>
                @if(Auth::user()->role_as == 1)
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages12" aria-expanded="false" aria-controls="collapsePages12">
                    <div class="sb-nav-link-icon"><i class='fas fa-comment' style='font-size:18px'></i></div>
                    Comments
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapsePages12" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        
                        <a class="nav-link" href="{{route('comments.index')}}">View Comments</a>
                    </nav>
                </div>
                @endif
               @endif
            </div>
        </div>
        <div class="sb-sidenav-footer">
            <div class="text-muted" style="font-size: 17px; text-align:center">
                Logged in as: <br/>
                <span class="text-primary">{{ Auth::user()->name }}</span>
            </div>
            <div class="text-muted" style="font-size: 17px; text-align:center">
                <span class="badge 
                    {{ Auth::user()->role_as == 1 ? 'bg-success' : 
                        (Auth::user()->role_as == '0' ? 'bg-primary' : 'bg-danger') }}" 
                    style="font-size: 15px;">
                    @if(Auth::user()->role_as == '1')
                        <i class="fas fa-crown"></i> SuperAdmin
                    @elseif(Auth::user()->role_as == '0')
                        <i class="fas fa-user-tie"></i> Employee
                    @else
                        <i class="fas fa-user"></i> Customer
                    @endif
                </span>
            </div>
        </div>
        
    </nav>
</div>