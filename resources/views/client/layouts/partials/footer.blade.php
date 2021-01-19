<footer>

    <div class="footer">
        <div class="container">
            <div class="row">
                <div class="col-sm-7">
                    <p class="small">
                        <span> <br>&copy; {{\MyHelper::bn_number($setting->copyright)}} সর্বস্বত্ব সংরক্ষিত | {{\App\Models\Setting::first()->value('company_name')}}</span><br>
                        <i class="fa fa-map-marker"></i> {{$setting->address1}}
                        <br>
                        <abbr title="Phone:"><i class="fa fa-phone"></i> </abbr> {{$setting->mobile_no1}} ,
                        <abbr title="Fax:"><i class="fa fa-fax"></i> </abbr> {{$setting->mobile_no2}}

                        {{--<a href="https://wa.me/8801700000000" class="small text-muted" target="_blank" rel="nofollow">--}}
                            {{--<abbr title="WhatsApp:"><i class="fa fa-whatsapp"></i> </abbr> +8801700000000<br>--}}
                        {{--</a>--}}
                        <br>
                        <span class="small">
                        <abbr title="Email:"><i class="fa fa-envelope"></i> </abbr>
                        {{$setting->email1}},
                        {{$setting->email2}}<br>
</span>
                    </p>
                </div>
                <div class="col-sm-5 footer-top hidden-print">
                    <ul class="footer-menu text-right">
                        <li class="paddingBottom10"><a href="{{url('/about-us.html')}}">আমাদের কথা</a></li>
                        <li class="paddingBottom10"><a href="{{url('/contact.htm')}}">যোগাযোগ </a></li>
                        <li class="paddingBottom10"><a href="{{url('/page/privacy-policy')}}" target="_blank">প্রাইভেসি পলিসি</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="scroll-top-wrapper hidden-print">
<span class="scroll-top-inner">
<i class="fa fa-2x fa-angle-up"></i>
</span>
        </div>
    </div>
</footer>