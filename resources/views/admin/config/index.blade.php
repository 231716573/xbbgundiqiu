@extends('layout.admin')

@section('title', '配置项列表')


@section('layout.content')
<style type="text/css">
.table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th { vertical-align: middle; text-align: center; }
</style>
<div class="col-xs-12 col-sm-9 col-md-10 container">
	<h3 class="form-group">配置项列表<small class="pull-right"><a class="btn btn-primary" href="{{ url('admin/config/create') }}">添加配置项</a></small></h3>
	<hr />
	<form action="{{ url('admin/config/changecontent') }}" method="post">
		{{ csrf_field() }}
	    <table class="table table-bordered">
	        <thead>
	            <tr class="info">
	            	<th style="width:80px;">排序</th>
	                <th style="width:150px;">标题</th>
	                <th style="width:150px;">名称</th>
	                <th>内容</th>
	                <th style="width:120px;">操作</th>
	            </tr>
	        </thead>
	        <tbody>
	        @foreach( $data as $d )
	            <tr>
	                <td>
	                	<input type="text" onchange="changeOrder(this, {{$d->config_id}})" value="{{ $d->config_order }}" style="width:40px; padding:3px 5px; text-align: center;">
	                </td>
	                <td>{{ $d->config_title }}</td>
	                <td>{{ $d->config_name }}</td>
	                <td style="text-align:left;">
						<input type="hidden" name="config_id[]" value="{{$d->config_id}}">
						{!! $d->_html !!}
	                </td>
	                <td>
	                    <a href="{{ url('admin/config/'. $d->config_id .'/edit') }}">修改</a>
	                    <a href="javascript:void(0);" onclick="delConfig({{ $d->config_id }})">删除</a>
	                </td>
	            </tr>
			@endforeach
	        </tbody>
	    </table>
	    <div class="form-group">
			<div class="col-sm-8">
		      	<button type="submit" class="btn btn-primary">提交</button>　
		      	<input type="button" class="back btn btn-info" onclick="history.go(-1)" value="返回" >
		    </div>
		</div>
    </form>
</div>

<script type="text/javascript">
function changeOrder(obj, config_id){
	var config_order = $(obj).val();
	$.post("{{ url('admin/config/changeorder') }}", 
		{ '_token': '{{csrf_token()}}', 'config_id': config_id, 'config_order': config_order },
		function (data){
			if( data.status == 0 ){
				layer.msg(data.msg, { icon: 6 });
			}else{
				layer.msg(data.msg, { icon: 5 });
			}
		});
}

// 删除分类
function delConfig(config_id){
	layer.confirm('你确定删除这个链接吗？', {
		btn: ['确定', '取消']
	}, function (){
		$.post("{{ url('admin/config/') }}/" +config_id, 
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