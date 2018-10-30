@extends('layout.admin')

@section('title', '日记列表')


@section('layout.content')
<style type="text/css">
.table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th { vertical-align: middle; text-align: center; }
</style>
<div class="col-xs-12 col-sm-9 col-md-10 container">
	<h3 class="form-group">日记列表<small class="pull-right"><a class="btn btn-primary" href="{{ url('admin/diary/create') }}">添加日记</a></small></h3>
	<hr />
    <table class="table table-bordered">
        <thead>
            <tr class="info">
            	<th style="width:60px;">ID</th>
                <th style="width:120px;">作者</th>
                <th>标题</th>
                <th style="width:100px;">查看次数</th>
                <th style="width:190px;">最后编辑时间</th>
                <th style="width:120px;">操作</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($diary as $d)
            <tr>
                <td>{{$d->id}}</td>
                <td>{{$d->diary_editor}}</td>
                <td style="text-align:left;">
					<a href="javascript:void(0);">{{ $d->diary_title }}</a>
                </td>
                <td>{{ $d->diary_view }}</td>
                <td>{{ date('Y-m-d H:i:s', $d->diary_time) }}</td>
                <td>
                    <a href="{{ url('admin/diary/'. $d->id) .'/edit' }}">修改</a>
                    <a href="javascript:void(0);" onclick="delArt({{ $d->id }})">删除</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

	<nav aria-label="Page navigation" class="text-right">
    {{ $diary->links() }}
    </nav>
</div>

<script type="text/javascript">

// 删除分类
function delArt(diary_id){
	layer.confirm('你确定删除这篇文章吗？', {
		btn: ['确定', '取消']
	}, function (){
		$.post("{{ url('admin/diary/') }}/" +diary_id,
			{'_method': 'delete', '_token': "{{ csrf_token() }}"},
			function (data){
				if(data.status == 0){
					location.href = location.href;
					layer.msg(data.msg, { icon: 6 });
				}else{
					layer.msg(data.msg, { icon: 5 });
				}
			})
	})
}
</script>
@endsection
