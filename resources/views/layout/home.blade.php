<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="renderer" content="webkit" /> 
    <meta http-equiv="X-UA-Compatible" content="chrome=1">
    <meta name="applicable-device" content="mobile">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
    <meta name="format-detection" content="telephone=no" />
    <meta name="wap-font-scale" content="no">
    <meta HTTP-EQUIV="pragma" content="no-cache"> 
    <meta HTTP-EQUIV="Cache-Control" content="no-cache, must-revalidate"> 
    <meta HTTP-EQUIV="expires" content="0">
    <meta charset="UTF-8">
    @yield('info')
    <link rel="stylesheet" href="{{ asset('home/css/common.css') }}">
    @yield('link')
</head>
<body>
<header class="bottom-box-shadow">
    <div class="header">
        <h1 id="logo"><a href="{{ url('/') }}"><img src="{{ asset('images/logo.png') }}" alt="logo"></a></h1>
        <nav class="topnav" id="topnav">
        @foreach($navs as $n=>$nav)
            <a href="{{ $nav->nav_url }}"><span>{{ $nav->nav_name }}</span><span class="en">{{ $nav->nav_alias }}</span></a>
        @endforeach
        </nav>
    </div>
</header>

@section('content')
@show
<div class="clear"></div>
<div class="footer" style=" background-color: #87d3d2;clear: both; margin-top: 50px;">
    <div class="footer-title">{{ Config::get('web.copyright') }}</div>
</div>
</body>
<script type="text/javascript" src="{{ asset('bootstrap/js/jquery-2.1.4.min.js') }}"></script>

@section('js')
@show
</html>