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
    @yield('headerscripts')
</head>
<body>
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
    <div class="admin-menu col-md-3">
        <h2 class="">Admin menu</h2>
        <ul class="nav nav-pills nav-stacked">
            <li><a href="/adm/sliders">Sliders</a></li>
            <li><a href="/adm/slider/add">Create slide</a></li>
            <li><a href="/adm/menus">Main menu</a></li>
            <li><a href="/adm/menu/add">Create menu item</a></li>
            <li><a href="/adm/subscriptions">Subscriptions</a></li>
        </ul>
    </div>
    <div class="col-md-9 content clearfix">
        @yield('content')
    </div>
</div>
<div class="footer">
    @yield('footer')
</div>
@yield('footerscripts')
</body>
</html>
