<footer class="py-5 bg-light mt-auto" style="font-size: 20px;">
    <div class="container-fluid px-5">
        <div class="d-flex align-items-center justify-content-between small">
            <div class="text-muted">Copyright &copy;
                @php
                $setting = App\Models\Setting::find(1);
                @endphp
                  <img src="{{asset('uploads/settings/'.$setting->logo)}}" style="width:20px;height:20px;">
                <span>{{$setting->website_name}}</span>
            </div>
            <div>
                <a href="tel:+917990653556" style="text-decoration: none">Contact us</a>
                &middot;
                <a style="text-decoration: none">Terms &amp; Conditions</a>
            </div>
        </div>
    </div>
</footer>