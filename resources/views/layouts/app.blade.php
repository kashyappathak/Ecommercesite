<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <title> @yield('title' , 'Ecommerce App | Authenticate')</title>
    
    @php
    $setting = App\Models\Setting::find(1);
    @endphp
    @if($setting)
    <link rel="shortcut icon" href="{{asset('uploads/settings/'.$setting->favicon)}}" type="image/x-icon">
    @endif

    <!-- Scripts -->
    {{-- <script src="{{ asset('js/app.js') }}"></script> --}}

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    
    <!-- Styles -->
    <link href="{{ asset('assets/css/styles.css') }}" rel="stylesheet">
    <link href="{{asset('assets/css/Demo.css') }}" rel="stylesheet">

    <link href="{{asset('assets/css/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{asset('assets/css/owl.theme.default.min.css') }}" rel="stylesheet">
     <!-- datatable cdn -->
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
 
     
    <style>
         .dataTables_wrapper .dataTables_paginate .paginate_button{
             padding: 0px !important;
             margin: 0px !important;   
         }
 
         div.dataTables_wrapper div.dataTables_length select{
            width:50% !important;
         }
       
    </style>

</head>
<body>
    <div id="app">
       @include('layouts.inc.frontend-navbar')

        <main class="">
            @yield('content')
        </main>
        
        @include('layouts.inc.frontend-footer')

    </div>
   
    <script src="{{asset('assets/js/jquery-3.6.0.min.js')}}"></script>
    <script src="{{asset('assets/js/owl.carousel.min.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="//cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    <script>
        let table = new DataTable('#myDatatable');
    </script>
    <script>
        $('.category-carousel').owlCarousel({
            loop:true,
            margin:10,
            nav:true,
            dots:false,
            responsive:{
                0:{
                    items:2
                },
                600:{
                    items:3
                },
                1000:{
                    items:4
                }
            }
        })
        
    </script>
    
    @yield('scripts')


    {{-- <script>
        window.onscroll = function() {myFunction()};
        
        var navbar = document.getElementById("navbar");
        var sticky = navbar.offsetTop;
        
        function myFunction() {
          if (window.pageYOffset >= sticky) {
            navbar.classList.add("sticky")
          } else {
            navbar.classList.remove("sticky");
          }
        }
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
                   
        });
        
        function addcart(id){
             
        $.ajax({
            url:'{{ url("/addcart/{id}")}}',
            type:'post',
            data:{id:id },
            dataType:'json',
            success:function(response) {
        
                if(response.status == true){
        
                    window.location.reload();
        
                }else{
                    alert(response.message);
                }
        
        
        
            }
        });
        
        }
        </script> --}}
        
        @yield('customJs')
</body>
</html>
