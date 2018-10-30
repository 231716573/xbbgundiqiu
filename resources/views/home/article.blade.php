@extends('layout.home')


@section('info')
<title>{{ $field->art_title }} - {{ Config::get('web.web_title') }}</title>
<meta name="keywords" content="{{ $field->art_tag }}" />
<meta name="description" content="{{ $field->art_description }}" />
@endsection



@section('link')
<link rel="stylesheet" href="{{ asset('home/css/article.css') }}">
@endsection



@section('content')
<div class="contain">
    <div class="column">
        <div class="weather"><iframe allowtransparency="true" frameborder="0" width="250" height="75" scrolling="no" src="//tianqi.2345.com/plugin/widget/index.htm?s=2&z=1&t=0&v=0&d=1&bd=0&k=&f=&ltf=009944&htf=cc0000&q=1&e=1&a=1&c=59287&w=250&h=75&align=center"></iframe></div>
        <div class="ep-title clearfix">
            <h2 class="title">热点内容</h2>
            <ul class="ep-list">
            @foreach($hot as $h)
                <li><a href="{{ url('/article/'.$h->art_id) }}">{{ $h->art_title }}</a></li>
            @endforeach
            </ul>
        </div>
        <div class="ep-title clearfix">
            <h2 class="title">文章推荐</h2>
            <ul class="ep-list">
            @foreach($data as $d)
                <li><a href="{{ url('/article/'.$d->art_id) }}">{{ $d->art_title }}</a></li>
            @endforeach
            </ul>
        </div>
    </div>
    <div class="article">
        <div class="art-cate">
            您当前的位置：<a href="{{ url('/') }}">首页</a>&nbsp;&gt;&nbsp;<a href="{{ url('category/'.$field->cate_id) }}">{{ $field->cate_name }}</a>
        </div>
        <h2 class="art-title">{{ $field->art_title }}</h2>
        <div class="art-author">
            <span class="art-author-span1">{{ date('Y-m-d', $field->art_time) }}</span>
            <span class="art-author-span2">作者：{{ $field->art_editor }}</span>
        </div>
        <div class="art_description">
            {{ $field->art_description }}
        </div>
        <div class="art-content">
            {!! $field->art_content !!}
        </div>
        <div class="bg-parent"><span class="bg"></span></div>
        <div class="art-keyword"><span>关键字</span>：{{ $field->art_tag }}</div>
        <div class="nextinfo">
            <p>下一篇：
            @if($article['next'])
                <a href="{{ url('/article/' . $article['next']->art_id) }}">
                    {{ $article['next']->art_title }}
                </a>
            @else
                <span>没有了</span>
            @endif
            </p>
            <p>上一篇：
            @if($article['pre'])
                <a href="{{ url('/article/' . $article['pre']->art_id) }}">
                    {{ $article['pre']->art_title }}
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