@extends('layout.home')


@section('info')
<title>{{ Config::get('web.web_title') }}-首页</title>
<meta name="keywords" content="123123" />
<meta name="description" content="123123" />
@endsection



@section('link')
<link rel="stylesheet" href="{{ asset('home/css/index.css') }}">
@endsection



@section('content')
<div class="contain">
    <div class="banner">
        <div class="banner-con">
            <img src="{{ asset('images/girl1.png') }}" alt="" class="banner-img1">
            <div>
                <img src="{{ asset('images/text1.png') }}" alt="ABC" class="banner-img2">
            </div>
        </div>
    </div>
    <div class="action_box_inner action_box-inner">
        <div class="action_box_content action_box-content">
            <div class="ac-content-text action_box-text">
                <h2 class="text action_box-title">{{ Config::get('web.well-known') }}：</h2>
                <h5>{{ Config::get('web.well-known-content') }}</h5>
            </div>
        </div>
    </div>

    <!-- 回忆 -->
    <div class="section">
        <h2>| 似水年华 |</h2>
        <div class="region">时间一去不复返； 美好的时光像水一样地流走，恍惚间已无法追寻，只流下无尽的怆然； 人生犹如流水一般，看起来数十年光阴哗哗的流逝掉了，而且一去不复返。</div>
        <div class="recallphoto">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>
    <div class="xian">
        <img src="{{ asset('images/xian1.png') }}" alt="">
    </div>
    <!-- 类别 -->
    <div class="section">
        <h2>| 闲情趣味 |</h2>
        <div class="region">管弦清，旋翻红袖学飞琼。光阴无暂住，欢醉有闲情。祝辰星。愿百千为寿、献瑶觥。情且与稻粱饱，寄语休将鸡鹜驱。夜凉喜无讼，霁色摇闲情。</div>
        <div class="recalltype">
        @foreach($cate as $c)
            <div>
                <img src="{{ asset('images/jishu.jpg') }}" alt="">
                <h3>{{ $c->cate_title }}</h3><p>{{ $c->cate_keywords }}</p>
                <a href="{{ url('/category/' . $c->cate_id) }}">详情+</a>
            </div>
        @endforeach
        </div>
    </div>
    <div class="xian">
        <img src="{{ asset('images/xian2.png') }}" alt="">
    </div>
    <div class="section-title">
        <div class="section-desc">
            <h3>点点滴滴</h3>
            <p>如果能让我重新再来一次，我希望我能再次出现你的生命里。不要这么容易就想放弃，就像我说的，追不到的梦想，换个梦不就得了</p>
        </div>
    </div>
    <div class="section">
        <div class="recallnote">
        @foreach($data as $d)
            <div>
                <a href="{{ url('/article/' . $d->art_id) }}" title="{{ $d->art_title }}"><img src="{{ $d->art_thumb }}" alt=""><span>阅读详情+</span></a>
                <em class="">{{ date('m-d', $d->art_time) }} {{ date('Y', $d->art_time) }} By author：<i href="">{{ $d->art_editor }}</i></em>
                <p>{{ $d->art_tag }}</p>
            </div>
        @endforeach 
        </div>
    </div>
</div>
@endsection



@section('js')
<script type="text/javascript">
$(function (){
    $(".banner .banner-con").css({
        'width' : $(window).width() + 'px',
        'height' : $(".banner .banner-con").width()/3 + "px"
    })
    $(".section .recallphoto").css({
        'width' : '100%',
        'height' : $(".section .recallphoto").width()/5 + "px"
    })
    $(".section .recallphoto div").css({
        'width' : '25%',
        'height' : $(".section .recallphoto div").width()*3/4 + "px"
    })
    $(".recallnote div a").css({
        'height' : $(".recallnote div a").width()*2.5/4 + "px"
    })
    $(window).resize(function(){
        $(".banner .banner-con").css({
            'width' : $(window).width() + 'px',
            'height' : $(".banner .banner-con").width()/3 + "px"
        })
        $(".section .recallphoto").css({
            'width' : '100%',
            'height' : $(".section .recallphoto").width()/5 + "px"
        })
        $(".section .recallphoto div").css({
            'width' : '25%',
            'height' : $(".section .recallphoto div").width()*3/4 + "px"
        })
        $(".recallnote div a").css({
            'height' : $(".recallnote div a").width()*2.5/4 + "px"
        })
    });

    $(".banner .banner-con div").css({
        'margin-top' : '-' + $(".banner .banner-con .banner-img2").height()/1.5 + "px"
    })

})
</script>
@endsection