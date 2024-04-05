<nav class="sb-topnav navbar navbar-expand navbar-dark " style="height: 40px;background-color:#2874F0;">
    <!-- Navbar Brand-->
   &nbsp; &nbsp; &nbsp; &nbsp;
    <div class="text-white font-bold">
       <br/>
        @php
            $setting = App\Models\Setting::find('1');

        @endphp<br/>
              <img src="{{asset('uploads/settings/'.$setting->logo)}}" width="30px" height="25px" style="border-radius: 30px;">
        <span style="font-size: 17px;">{{$setting->website_name}}</span><br/>
      &nbsp;<span style="font-size:15px;">  @if(Auth::user()->role_as == '1')
            <i class="fas fa-crown"></i> <span style="font-size: 17px;" >{{Auth::user()->name}}</span><br/>
        @elseif(Auth::user()->role_as == '0')
            <i class="fas fa-user-tie"></i>  <span style="font-size: 17px;">{{Auth::user()->name}}</span><br/>
        @else
            <i class="fas fa-user"></i>  <span style="font-size: 17px;">{{Auth::user()->name}}</span><br/>
        @endif<br/></span>
          
      </div><br/>

  &nbsp;&nbsp;&nbsp;&nbsp;
        
    <!-- Sidebar Toggle-->
    <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>

  
    <!-- Navbar Search-->
    @if(Auth::check())
    <form action="{{url('admin/search')}}" method="GET" class="ms-auto">
        @csrf
        <div class="input-group">
            <input class="form-control" type="text" name="search" placeholder="Search for..." value="{{isset($search) ? $search : ''}}" aria-describedby="btnNavbarSearch" id="searchInput" />
           
            <button class="btn btn-light" id="button" type="submit" onclick="return validateSearch()">
                <svg width="20" height="20" viewBox="0 0 17 18" class="" xmlns="http://www.w3.org/2000/svg">
                    <g fill="#2874F1" fill-rule="evenodd">
                        <path class="_34RNph" d="m11.618 9.897l4.225 4.212c.092.092.101.232.02.313l-1.465 1.46c-.081.081-.221.072-.314-.02l-4.216-4.203"></path>
                        <path class="_34RNph" d="m6.486 10.901c-2.42 0-4.381-1.956-4.381-4.368 0-2.413 1.961-4.369 4.381-4.369 2.42 0 4.381 1.956 4.381 4.369 0 2.413-1.961 4.368-4.381 4.368m0-10.835c-3.582 0-6.486 2.895-6.486 6.467 0 3.572 2.904 6.467 6.486 6.467 3.582 0 6.486-2.895 6.486-6.467 0-3.572-2.904-6.467-6.486-6.467"></path>
                    </g>
                </svg>
            </button>
        </div>
    </form>
    <div id="alertContainer"></div>
    
    <script>
    function validateSearch() {
        var searchInput = document.getElementById('searchInput').value.trim();
        if (searchInput === '') {
            var alertDiv = document.createElement('div');
            alertDiv.className = 'alert alert-warning fade show';
            alertDiv.setAttribute('role', 'alert');
            alertDiv.innerHTML = '👉First Search 👈' 
            document.getElementById('alertContainer').appendChild(alertDiv);
            
            return false; // Prevent form submission
        }
        return true; // Allow form submission
    }
    </script>
    
    @endif
    <!-- Navbar-->
    <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
      
     
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i style="color:white;" class="fas fa-user fa-fw"></i></a>
            <ul style="color:white;" class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                
         
             <a class="dropdown-item" href="{{url('admin/profiles')}}">Profile</a>


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
</nav>