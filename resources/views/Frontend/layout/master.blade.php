<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Blog | E-Shopper</title>
    <link href="{{ asset('Frontend/css/bootstrap.min.css') }}" rel="stylesheet"> 
    <link href=" {{ asset('Frontend/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('Frontend/css/prettyPhoto.css') }}" rel="stylesheet">
    <link href="{{ asset('Frontend/css/price-range.css') }}" rel="stylesheet">
    <link href="{{ asset('Frontend/css/animate.css') }}" rel="stylesheet">
	<link href="{{ asset('Frontend/css/main.css') }}" rel="stylesheet">
	<link href="{{ asset('Frontend/css/responsive.css') }}" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="{{ asset('Frontend/css/rate.css') }}">
    <script src="{{ asset('Frontend/js/jquery-1.9.1.min.js') }}"></script>

    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->       
    <link rel="shortcut icon" href="images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
</head><!--/head-->

<body>

    @include('Frontend.layout.header')
    
    @php
        $currentUrl = url()->current();
    @endphp
    
    @if(\Illuminate\Support\Str::contains($currentUrl,'blog') || \Illuminate\Support\Str::contains($currentUrl,'product/home') || \Illuminate\Support\Str::contains($currentUrl,'product/search'))
        <section>    
            <div class="container">
                <div class="row">
                    @include('Frontend.layout.menu-left')
                    @yield('content')
                </div>
            </div>
        </section>
    @elseif(\Illuminate\Support\Str::contains(url()->current(),'member'))
        <section>    
            <div class="container">
                <div class="row">
                    @yield('content')
                </div>
            </div>
        </section>
    @elseif(\Illuminate\Support\Str::contains($currentUrl,'account'))
        @if(\Illuminate\Support\Str::contains($currentUrl,'cart') )
            @yield('content1')
        @else
            <section>    
                <div class="container">
                    <div class="row">
                        @include('Frontend.layout.slide')
                        @yield('content')
                    </div>
                </div>
            </section>  
        @endif
    @elseif(\Illuminate\Support\Str::contains($currentUrl,'checkout'))
        @yield('content1')
    @endif 
	
    @include('Frontend.layout.footer')

    <script src="{{ asset('Frontend/js/jquery.js') }}"></script>    
	<script src="{{ asset('Frontend/js/price-range.js') }}"></script>
	<script src="{{ asset('Frontend/js/jquery.scrollUp.min.js') }}"></script> 
	<script src="{{ asset('Frontend/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('Frontend/js/jquery.prettyPhoto.js') }}"></script>
    <script src="{{ asset('Frontend/js/main.js') }}"></script>
    
</body>
</html>