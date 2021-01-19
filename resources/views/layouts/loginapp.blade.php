<!DOCTYPE html>

<html lang="en">

<!-- begin::Head -->
<head>
    <meta charset="utf-8" />
    <title>Login Page | {{\App\Models\Setting::first()->value('company_name')}}</title>
    <meta name="description" content="{{\App\Models\Setting::first()->value('company_slogan')}}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!--begin::Fonts -->
    <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
    <script>
        WebFont.load({
            google: {
                "families": ["Poppins:300,400,500,600,700", "Roboto:300,400,500,600,700"]
            },
            active: function() {
                sessionStorage.fonts = true;
            }
        });
    </script>

    <!--end::Fonts -->
    <link href="{{asset('/')}}/assets/css/demo1/pages/login/login-4.css" rel="stylesheet" type="text/css" />

    <link href="{{asset('/')}}/assets/css/demo1/style.bundle.css" rel="stylesheet" type="text/css" />

    <link rel="shortcut icon" href="{{asset('/public')}}/assets/media/logos/favicon.ico" />
</head>

<!-- end::Head -->

<!-- begin::Body -->
<body class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--enabled kt-subheader--fixed kt-subheader--solid kt-aside--enabled kt-aside--fixed kt-page--loading">

<!-- begin:: Page -->
@yield('content')

<!-- end:: Page -->
</body>

<!-- end::Body -->
</html>