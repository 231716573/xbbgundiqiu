@extends('layout.home')


@section('info')
<title>{{ $field->diary_title }} - {{ Config::get('web.web_title') }}</title>
<meta name="keywords" content="{{ $field->diary_tag }}" />
<meta name="description" content="{{ $field->diary_description }}" />
@endsection



@section('link')
<link rel="stylesheet" href="{{ asset('home/css/article.css') }}">
<style type="text/css">
.art-content { margin:25px 0; }
</style>
@endsection



@section('content')
<div class="contain">
    <div class="column">
        <div class="weather"><iframe allowtransparency="true" frameborder="0" width="250" height="75" scrolling="no" src="//tianqi.2345.com/plugin/widget/index.htm?s=2&z=1&t=0&v=0&d=1&bd=0&k=&f=&ltf=009944&htf=cc0000&q=1&e=1&a=1&c=59287&w=250&h=75&align=center"></iframe></div>
    </div>
    <div class="article">
        <div class="art-cate">
            您当前的位置：<a href="{{ url('/') }}">首页</a>&nbsp;-&gt;&nbsp;<a href="{{ url('diary') }}">日记</a>&nbsp;-&gt;&nbsp;<a href="{{ url('diary/'.$field->id) }}">{{ $field->diary_title }}</a>
        </div>
        <h2 class="art-title">{{ $field->diary_title }}</h2>
        <div class="art-author">
            <span class="art-author-span1" style="float: right; padding-right: 10px;">浏览量：{{ $field->diary_view }}</span>
            <span class="art-author-span1">{{ date('Y-m-d', $field->diary_time) }}</span>
            <span class="art-author-span2">作者：{{ $field->diary_editor }}</span>

        </div>
        <div class="art-content">
            {!! $field->diary_content !!}
        </div>
        <div class="bg-parent"><span class="bg"></span></div>
        <div class="art-keyword"><span>关键字</span>：{{ $field->diary_tag }}</div>
        <div class="nextinfo">
            <p>下一篇：
            @if($diary['next'])
                <a href="{{ url('/diary/' . $diary['next']->id) }}">
                    {{ $diary['next']->diary_title }}
                </a>
            @else
                <span>没有了</span>
            @endif
            </p>
            <p>上一篇：
            @if($diary['pre'])
                <a href="{{ url('/diary/' . $diary['pre']->id) }}">
                    {{ $diary['pre']->diary_title }}
                </a>
            @else
                <span>没有了</span>
            @endif
            </p>
        </div>
    </div>
</div>
@endsection



@section('js')
<script type="text/javascript">

</script>
@endsection