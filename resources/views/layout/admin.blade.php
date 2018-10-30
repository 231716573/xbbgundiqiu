@extends('layout.houtai')

<!-- 左侧挂件 -->
@section('layout.left')
<style type="text/css">
.nav-header { color:#fff; }
div.bg-primary { padding: 10px; }
.bg-default li a { padding:10px 20px; }
a.nav-header:focus, a.nav-header:hover { color: #fff; text-decoration: none; }
</style>
<div class="col-xs-12 col-sm-3 col-md-2">
    
    <!-- 个人头像 -->
    <div class="nav-portrait" style="text-align: center;margin-bottom: 20px;">
        <img src="/{{ session('user.user_thumb') }}" alt="头像" class="img-circle">
        <h3 style="font-size: 20px; margin:7px 0px;">{{ session('user.user_realname') }}</h2>
        <p><a href="{{ url('/admin/profile') }}" title="修改个人资料">个人资料 <i class="glyphicon glyphicon-pencil"></i></a></p>
    </div>
    <!-- 时钟 -->
    <div id="clock">
        <p class="date"></p>
        <p class="time"></p>
    </div>
    <!-- 导航 -->
    <div class="sidebar-nav bs-example-bg-classes">  
<!--         <div class="bg-primary">
            <a href="#dashboard-menu" class="nav-header" data-toggle="collapse"><i class="icon-dashboard"></i>首页</a>
        </div> -->
        
        <div class="bg-primary">
            <a href="#table-menu" class="nav-header" data-toggle="collapse"><i class="icon-table"></i>文章管理</a>
        </div>
        <ul id="table-menu" class="nav nav-list collapse in bg-default">  
            <li><a href="{{ url('/admin/article') }}">文章列表</a></li>  
            <li><a href="{{ url('/admin/category') }}">文章分类</a></li>  
        </ul>  

        <div class="bg-primary">
            <a href="#menu-menu" class="nav-header" data-toggle="collapse"><i class="icon-reorder"></i>前台管理</a>  
        </div>
        <ul id="menu-menu" class="nav nav-list collapse in bg-default">  
            <li><a href="{{ url('/admin/navs') }}">导航栏</a></li>
            <li><a href="{{ url('/admin/link') }}">友情链接</a></li>
        </ul>

        <div class="bg-primary">
            <a href="#privacy-menu" class="nav-header" data-toggle="collapse"><i class="icon-th-large"></i>隐私管理</a>
        </div>  
        <ul id="privacy-menu" class="nav nav-list collapse in bg-default">  
            <li><a href="{{ url('/admin/picture') }}">相册</a></li> 
            <li><a href="{{ url('/admin/diary') }}">日记</a></li>
        </ul>  

        <div class="bg-primary">
            <a href="#order-menu" class="nav-header" data-toggle="collapse"><i class="icon-th-large"></i>系统管理</a>
        </div>  
        <ul id="order-menu" class="nav nav-list collapse in bg-default">  
            <li><a href="{{ url('/admin/config') }}">网站配置</a></li> 
        </ul>  

    </div>  
</div>
@endsection


<!-- 内容 -->
@section('layout.content')
<div class="col-xs-12 col-sm-9 col-md-10">
    @section("content")
        
    @show
</div>
@endsection