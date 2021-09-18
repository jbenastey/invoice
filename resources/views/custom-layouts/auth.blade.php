<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title>Invoice | @yield('title')</title>
    <meta content="Responsive admin theme build on top of Bootstrap 4" name="description" />
    <meta content="Themesbrand" name="author" />
    <link rel="shortcut icon" href="{{asset('veltrix/assets/images/bill.png')}}">

    <link href="{{asset('veltrix/assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('veltrix/assets/css/metismenu.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('veltrix/assets/css/icons.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('veltrix/assets/css/style.css')}}" rel="stylesheet" type="text/css">
</head>

<body class="bg-primary">
<div class="home-btn d-none d-sm-block">
    <a href="{{url('/')}}" class="text-white"><i class="fas fa-home h2"></i></a>
</div>

<div class="account-pages my-5 pt-5">
    <div class="container">
        @yield('content')
    </div>
</div>

<!-- jQuery  -->
<script src="{{asset('veltrix/assets/js/jquery.min.js')}}"></script>
<script src="{{asset('veltrix/assets/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('veltrix/assets/js/metismenu.min.js')}}"></script>
<script src="{{asset('veltrix/assets/js/jquery.slimscroll.js')}}"></script>
<script src="{{asset('veltrix/assets/js/waves.min.js')}}"></script>

<!-- App js -->
<script src="{{asset('veltrix/assets/js/app.js')}}"></script>

</body>

</html>
