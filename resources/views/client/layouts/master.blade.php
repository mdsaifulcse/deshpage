<!DOCTYPE HTML>
<html lang="en-US">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title> {{\App\Models\Setting::first()->value('company_name')}} | @yield('title') </title>
    <meta property='og:locale' content='en_US' />
    <meta name="theme-color" content="#9a1515">

    <link rel="dns-prefetch" href="https://maxcdn.bootstrapcdn.com/">
    <link rel="preconnect" href="https://maxcdn.bootstrapcdn.com/">

    <link rel="stylesheet" type="text/css" href="{{asset('/client/assets')}}/common/plugins/bootstrap-3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('/client/assets')}}/common/plugins/font-awesome-4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" type="text/css" href="{{asset('/client/assets')}}/common/css/corona-widget.css">
    <link rel="stylesheet" type="text/css" href="{{asset('/client/assets')}}/common/css/SolaimanLipi.css">
    <link rel="stylesheet" type="text/css" href="{{asset('/client/assets')}}/common/css/style.css">

    <link rel="shortcut icon" type="image/x-icon" href="{{asset(\App\Models\Setting::first()->value('favicon'))}}" />

    <?php
     $requestDevice=$_SERVER['HTTP_USER_AGENT'];

    if(stristr("$requestDevice", "Mobile") || stristr("$requestDevice", "Tablet") || stristr("$requestDevice", "Tab")){ // if mobile browser
    ?>

    <!-- for mobile menu start-->
    <link rel="stylesheet" href="{{asset('/client/assets')}}/mobile/assets/css/m-common_2.css">
    <link rel="stylesheet" href="{{asset('/client/assets')}}/mobile/assets/css/m-news-style.css">

    <link rel="apple-touch-icon" href="{{asset('/client/assets')}}/media/common/icon/apps-Icon-256x256.png">
    <!-- for mobile menu end-->

    <?php
    }
    else { // desktop browser
    ?>

    <?php
    }
    ?>


    <meta property="" content="website" />

    <meta content="360" http-equiv="refresh">

    <script src="{{asset('/client/assets')}}/common/js/lazyload.js"></script>

    <link rel="stylesheet" href="{{asset('/client/assets')}}/common/css/custom.css">
    <link rel="stylesheet" href="{{asset('/client/assets')}}/common/css/responsive.css">

    @yield('style')

</head>
<body>

@include('client.layouts.partials.header')

@if(!empty($topA))

<section class="box-white hidden-print">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 text-center paddingTopBottom10 advertisement">

                <div id='topA'>
                    <a id="topA" target="_blank" href="{{$topA->target_url}}"  onclick="ha('topA')"><img src="{{asset($topA->image)}}"/> </a>
                </div>

                {{--<span>{{$_SERVER['HTTP_USER_AGENT']}}</span>--}}

                {{--ftp: deshpage.com--}}
                {{--username: desh@deshpage.com--}}
                {{--Pass: LsW3!-3*yS}B--}}

                {{--DB:ustutor1_deshpage_db--}}
                {{--user:ustutor1_deshpage_user--}}
                {{--pass: ~(OS*pB,n%@T--}}

            </div>
        </div>
    </div>
</section>

@endif


<main id="main-content">

@yield('content')

</main>

@if(!empty($bottomA))


<section class="box-white hidden-print">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 text-center paddingTopBottom10 advertisement topA">
                <div id='bottomA'>
                    <a id="bottomA" target="_blank" href="{{$bottomA->target_url}}" onfocus="ss('bottomA')" onmousedown="st('bottomA')"
                       onmouseover="ss('bottomA')" onclick="ha('bottomA')">
                        <img src="{{asset($bottomA->image)}}" border="0" alt="" class="img_ad img-responsive" style="margin:0px auto 15px;">
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>




@endif

@include('client.layouts.partials.footer')


<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
{{--<script data-cfasync="false" src="cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>--}}
<script type="text/javascript" src="{{asset('/client/assets')}}/common/js/jquery-2.1.4.min.js"></script>
<script type="text/javascript" src="{{asset('/client/assets')}}/common/plugins/bootstrap-3.3.7/js/bootstrap.min.js"></script>
<script defer src="{{asset('/client/assets')}}/common/js/news24.js"></script>

<!-- for mobile menu -->

<?php
$requestDevice=$_SERVER['HTTP_USER_AGENT'];

if(stristr("$requestDevice", "Mobile") || stristr("$requestDevice", "Tablet") || stristr("$requestDevice", "Tab")){ // if mobile browser
?>

<script src="{{asset('/client/assets')}}/mobile/assets/js/custom_2.js"></script>

<?php
}
?>
<!-- for mobile end -->

<script>
    jQuery(function($){
        var windowWidth = $(window).width();
        var windowHeight = $(window).height();

        $(window).resize(function() {
            if(windowWidth != $(window).width() || windowHeight != $(window).height()) {
                location.reload();
                return;
            }
        });
    });
</script>


@yield('script')

</body>
</html>
