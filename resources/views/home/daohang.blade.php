@extends('layout.home')


@section('info')
<title>导航 - {{ Config::get('web.web_title') }}</title>
<meta name="keywords" content="导航地图" />
<meta name="description" content="导航地图，文章，日记，首页" />
@endsection



@section('link')
<link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
<style type="text/css">
.contain {
    width: 100%;
    max-width: 1120px;
    margin: 0 auto;
    position: relative;
    margin-top: 3px;
}
</style>
@endsection



@section('content')
<div class="contain">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>中文</th>
                <th>#</th>
                <th><a target="_blank" href="javascript:void(0);">地址</a></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th scope="row">1</th>
                <td>首页</td>
                <td>Otto</td>
                <td><a target="_blank" href="{{ url('/') }}">{{ url('/') }}</a></td>
            </tr>
            <tr>
                <th scope="row">2</th>
                <td>日记</td>
                <td>Thornton</td>
                <td><a target="_blank" href="{{ url('/diary') }}">{{ url('/diary') }}</a></td>
            </tr>
            <tr>
                <th scope="row">3</th>
                <td>体育</td>
                <td>the Bird</td>
                <td><a target="_blank" href="{{ url('/category/1') }}">{{ url('/category/1') }}</a></td>
            </tr>
            <tr>
                <th scope="row">4</th>
                <td>娱乐</td>
                <td>the Bird</td>
                <td><a target="_blank" href="{{ url('/category/2') }}">{{ url('/category/2') }}</a></td>
            </tr>
            <tr>
                <th scope="row">5</th>
                <td>足迹</td>
                <td>the Bird</td>
                <td><a target="_blank" href="{{ url('/category/11') }}">{{ url('/category/11') }}</a></td>
            </tr>
            <tr>
                <th scope="row">5</th>
                <td>嘉嘉</td>
                <td>the Bird</td>
                <td><a target="_blank" href="{{ url('/category/12') }}">{{ url('/category/12') }}</a></td>
            </tr>
        </tbody>
    </table>
</div>
@endsection



@section('js')
<script type="text/javascript">

</script>
@endsection