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
    <link href="/css/app.css" rel="stylesheet" type="text/css" >
    <link href="/css/radio.css" rel="stylesheet" type="text/css" >

    {{--Owl slider --}}
    <link rel="stylesheet" href="/packages/owl/owl-carousel/owl.carousel.css">
    <link rel="stylesheet" href="/packages/owl/owl-carousel/owl.theme.css">
    <script src="/packages/owl/owl-carousel/owl.carousel.js"></script>
    {{--Owl slider ends--}}
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:100,200,300,400,500,600,700,800,900" rel="stylesheet">
    <link rel="shortcut icon" href="/images/favicon.ico" type="image/x-icon">
    <link rel="icon" href="/images/favicon.ico" type="image/x-icon">

    @yield('headerscripts')
</head>
<body>
@yield('navigation')
<div class="main-menu-wrapper navbar navbar-default clearfix">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#mm-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">Custom software development company</a>
        </div>
        <div id="mm-collapse" class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                @foreach($menus as $menu)
                    <li class="@if(count($menu['submenus']) > 0) dropdown @endif">
                        @if(!count($menu['submenus']))
                            <a href="/{{$menu->url}}"><span>{{$menu->title}}</span></a>
                        @else
                            <a href="/{{$menu->url}}" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{$menu->title}}<span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                @foreach($menu['submenus'] as $sumbenu)
                                    <li><a href="/{{$sumbenu->url}}">{{$sumbenu->title}}</a></li>
                                @endforeach
                            </ul>
                        @endif
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
<div class="body-conatiner">
    <div class="content clearfix">
        <div class="full-width">
            <div class="content-wrapper">
                <div class="slider col-md-6">
                    <div class="offer-label">We offer</div>
                    <div id="owl-slider" class="owl-carousel">
                        @foreach($sliders as $slider)
                            <div class="slide-wrapper">
                                <div class="lazyOwl"
                                     style="width: 100%; height: 840px !important; max-height: 900px; background-image:url({{url("images/slides")}}/{{$slider->id}}/{{$slider->image}});"
                                ></div>
                                <div class="slide-text-wrapper">
                                    <span class="slide-title-text open-sans-font">{{$slider->body}}</span>
                                </div>
                                <div class="slider-button">
                                    <a href="{{url($slider->url)}}" class="slider-button-link">{{$slider->link_text}}</a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="subscription col-md-6">
                    <div class="logs">
                        @if(Session::has('message'))
                            <div class="alert alert-success">
                                {{Session::get('message')}}
                            </div>
                        @endif
                    </div>
                    @yield('content')

                </div>
            </div>
        </div>
    </div>
</div>
<div class="footer">
    @yield('footer')
    <div class="footer-menu-wrapper navbar navbar-default clearfix">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="#">&copy; @php echo date("Y"); @endphp Redwerk. All rights reserved.</a>
            </div>
            <div id="mm-collapse" class="navbar-collapse collapse">
                <ul class="nav navbar-nav navbar-right">
                    @foreach($menus as $menu)
                        <li class="">
                            <a href="/{{$menu->url}}"><span>{{$menu->title}}</span></a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
@yield('footerscripts')
<script>
    $(document).ready(function() {
        $("#owl-slider").owlCarousel({
            singleItem: true,
            slideSpeed : 600,
            paginationSpeed : 600,
            navigation : false,
            autoPlay: false,
            stopOnHover: true,
            navigationText: false,
            responsive: true,
            addClassActive: true,
            pagination: true
        });
    });
</script>
</body>
</html>
