@extends('layout.home')


@section('info')
<title>日记 - {{ Config::get('web.web_title') }}</title>
<meta name="keywords" content=" $field->cate_keywords }}" />
<meta name="description" content="日记" />
@endsection



@section('link')
<link rel="stylesheet" href="{{ asset('home/css/articlelist.css') }}">
@endsection



@section('content')
<div class="contain">
    <div class="column">
        <div class="weather"><iframe allowtransparency="true" frameborder="0" width="250" height="75" scrolling="no" src="//tianqi.2345.com/plugin/widget/index.htm?s=2&z=1&t=0&v=0&d=1&bd=0&k=&f=&ltf=009944&htf=cc0000&q=1&e=1&a=1&c=59287&w=250&h=75&align=center"></iframe></div>
    </div>
    <div class="article">
        <div class="art-cate">
            您当前的位置：<a href="{{ url('/') }}">首页</a>&nbsp;-&gt;&nbsp;<a href="{{ url('diary') }}">日记</a>
        </div>
        <ul class="art-list">
        @foreach ($data as $d)
            <li>
                @if( $d->diary_thumb )
                    <a class="art-list-img" href="{{ url('/diary/'.$d->id) }}" target="_blank"><img src="{{ asset($d->diary_thumb) }}" alt="{{ $d->diary_title }}"></a>
                @endif
                <div class="art-list-con">
                    <h3 class="itemTitle kl-blog-item-title"><a href="{{ url('/diary/'.$d->id) }}" target="_blank">{{ $d->diary_title }}</a></h3>
                    <div>
                        <span class="catItemDateCreated kl-blog-item-date">{{ date("Y-m-d", $d->diary_time) }}, {{ date("H:i", $d->diary_time) }}</span>
                        <span>BY <i>{{ $d->diary_editor }}</i></span>
                    </div>
                    <p>{{ $d->diary_tag }}</p>
                </div>
                <div class="art-list-link">{{ $d->diary_description }}</div>
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