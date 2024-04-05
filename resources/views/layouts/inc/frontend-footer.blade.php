<footer class="py-4  bg-light mt-auto">
    <div class="container-fluid px-4">
            <div class="row">
             <div class="col-md-6">
                 <h2>
             
                 </h2>
                 <div class="underline"></div>
                 <p style="font-weight:bold;border-left: 6px solid black;">
                    @php
                    $setting = App\Models\Setting::find(1);
                   
                    @endphp 
                <h4>{{$setting->website_name}}</h4>
                 </p>
             </div>
             <div class="col-md-3">
                <h5 style="border-left: 6px solid black;">Links</h5>
                <div class="underline"></div>
                <div><a href="{{url('Front/')}}" style="font-weight: bold;" class="text-decoration-none text-black">Home</a></div>
                <div><a href="tel:+917990653556" style="font-weight: bold;" class="text-decoration-none text-black">Contact us</a></div>
                <div><a href="aboutus" style="font-weight: bold;"  class="text-decoration-none text-black">About us</a></div>
                <div><a href="mailto:Ecommercesite@gmail.com" style="font-weight: bold;"  class="text-decoration-none text-black">Query👈</a></div>
 
 
             </div>
             <div class="col-md-3">
                 <h5 style="border-left: 6px solid black;">Follows on</h5>
                 <div class="underline"></div>
                 <div><a href="#" style="font-weight: bold;"  class="text-decoration-none text-black">Instagram</a></div>
                 <div><a href="https://www.linkedin.com/in/pathak-kashyap-a2125b1ba/"style="font-weight: bold;" class="text-decoration-none text-black">Linkedin</a></div>
             </div>
            
            </div>
     
        </div>
 
    </div>
   
   
</footer>
<div class="py-4 bg-dark">
 
    <div class="container text-center">
        <p class="mb-2 text-white">
        <h5 style="color: white;font-size:15px;">   &copy; Copyright at &nbsp;{{$setting->website_name}}</h5>
  
        </p>
        <div class="mb-0">
            <a href="privacypolicy" style="text-decoration: none;color:white;font-size:15px;">Privacy Policy</a>
             &middot;
            <a href="#" style="text-decoration: none;color:white;font-size:15px;">Terms &amp; Conditions</a>
        </div>
     </div>
</div>