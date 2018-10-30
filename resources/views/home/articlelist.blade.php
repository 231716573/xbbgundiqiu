@extends('layout.home')


@section('info')
<title>{{ $field->cate_name }} - {{ Config::get('web.web_title') }}</title>
<meta name="keywords" content="{{ $field->cate_keywords }}" />
<meta name="description" content="{{ $field->cate_description }}" />
@endsection



@section('link')
<link rel="stylesheet" href="{{ asset('home/css/articlelist.css') }}">
@endsection



@section('content')
<div class="contain">
    <div class="column">
        <div class="weather"><iframe allowtransparency="true" frameborder="0" width="250" height="75" scrolling="no" src="//tianqi.2345.com/plugin/widget/index.htm?s=2&z=1&t=0&v=0&d=1&bd=0&k=&f=&ltf=009944&htf=cc0000&q=1&e=1&a=1&c=59287&w=250&h=75&align=center"></iframe></div>
        @if( $submenu->all() )
        <div class="submenu">
            <ul>
            @foreach( $submenu as $k=>$sub )
                <li class="submenu{{$k+1}}"><a href="{{ url('/category/' . $sub->cate_id) }}" target="_blank">{{ $sub->cate_name }}</a></li>
            @endforeach
            </ul>
        </div>
        @endif
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
            @foreach($new as $n)
                <li><a href="{{ url('/article/'.$n->art_id) }}">{{ $n->art_title }}</a></li>
            @endforeach
            </ul>
        </div>
    </div>
    <div class="article">
        <div class="art-cate">
            您当前的位置：<a href="{{ url('/') }}">首页</a>&nbsp;&gt;&nbsp;<a href="{{ url('category/'.$field->cate_id) }}">{{ $field->cate_name }}</a>
        </div>
        <ul class="art-list">
        @foreach($data as $d)
            <li>
                <a class="art-list-img" target="_blank" href="{{ url('/article/'.$d->art_id) }}"><img src="{{ asset($d->art_thumb) }}" alt="{{ $d->art_title }}"></a>
                <div class="art-list-con">
                    <h3 class="itemTitle kl-blog-item-title"><a target="_blank" href="{{ url('/article/'.$d->art_id) }}">{{ $d->art_title }}</a></h3>
                    <div>
                        <span class="catItemDateCreated kl-blog-item-date"> {{ date("Y-m-d", $d->art_time) }}, {{ date("H:i", $d->art_time) }}</span>
                        <span>BY <i>{{ $d->art_editor }}</i></span>
                    </div>
                    <p>{{ $d->art_tag }}</p>
                </div>
                <div class="art-list-link">{{ $d->art_description }}</div>
            </li>
        @endforeach
        </ul>
    </div>
</div>
@endsection



@section('js')
<script type="text/javascript">

</script>
@endsection