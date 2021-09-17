<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title>Invoice - @yield('judul_halaman')</title>
    <meta content="Invoice" name="description"/>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta content="Invoice" name="invoice"/>
    <link rel="shortcut icon" href="{{asset('veltrix/assets/images/favicon.ico')}}">

    {{-- load from laravel mix --}}
    <link href="{{asset('veltrix/assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">

</head>

<body class="bg-white">


            @yield('content')

<!-- END wrapper -->

</body>

</html>
