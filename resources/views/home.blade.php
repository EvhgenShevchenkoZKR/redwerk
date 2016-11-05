<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="format-detection" content="telephone=no">
    {{--Jquery--}}
    <script type="text/javascript" src="/js/jquery/jquery-2.2.4.min.js"></script>
    <!-- BOOTSTRAP -->
    <link rel="stylesheet" href="/packages/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/packages/bootstrap/css/bootstrap-theme.min.css">
    <script src="/packages/bootstrap/js/bootstrap.min.js"></script>
    {{--Main css files compiled from less via gulp--}}
    <link href="/css/admin.css" rel="stylesheet" type="text/css" >
    <link href="/css/app.css" rel="stylesheet" type="text/css" >
    <link href="/css/radio.css" rel="stylesheet" type="text/css" >
    <link rel="shortcut icon" href="/images/favicon.ico" type="image/x-icon">
    <link rel="icon" href="/images/favicon.ico" type="image/x-icon">
    @yield('headerscripts')
</head>
<body class="body-white">
@yield('navigation')
<div class="container body-conatiner">
    <div class="logs">
        @if(Session::has('message'))
            <div class="alert alert-success">
                {{Session::get('message')}}
            </div>
        @endif

        @if($errors->any())
            <div class="msg-errors">
                @foreach($errors->all() as $error)
                    <div class="alert alert-danger">
                        {{$error}}
                    </div>
                @endforeach
            </div>
        @endif
    </div>
    <div class="col-md-12 content clearfix">
        @yield('content')
    </div>
</div>
<div class="footer">
    @yield('footer')
</div>
@yield('footerscripts')
</body>
</html>
