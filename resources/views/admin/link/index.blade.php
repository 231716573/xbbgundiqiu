@extends('layout.admin')

@section('title', '友情链接列表')


@section('layout.content')
<style type="text/css">
.table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th { vertical-align: middle; text-align: center; }
</style>
<div class="col-xs-12 col-sm-9 col-md-10 container">
	<h3 class="form-group">友情链接列表<small class="pull-right"><a class="btn btn-primary" href="{{ url('admin/link/create') }}">添加友情链接</a></small></h3>
	<hr />
    <table class="table table-bordered">
        <thead>
            <tr class="info">
            	<th style="width:80px;">排序</th>
                <th style="width:150px;">名称</th>
                <th style="width:150px;">标题</th>
                <th>地址</th>
                <th style="width:120px;">操作</th>
            </tr>
        </thead>
        <tbody>
        @foreach( $data as $d )
            <tr>
                <td>
                	<input type="text" onchange="changeOrder(this, {{$d->link_id}})" value="{{ $d->link_order }}" style="width:40px; padding:3px 5px; text-align: center;">
                </td>
                <td>{{ $d->link_name }}</td>
                <td>{{ $d->link_title }}</td>
                <td style="text-align:left;">{{ $d->link_url }}</td>
                <td>
                    <a href="{{ url('admin/link/'. $d->link_id .'/edit') }}">修改</a>
                    <a href="javascript:void(0);" onclick="delLink({{ $d->link_id }})">删除</a>
                </td>
            </tr>
		@endforeach
        </tbody>
    </table>
</div>

<script type="text/javascript">
function changeOrder(obj, link_id){
	var link_order = $(obj).val();
	$.post("{{ url('admin/link/changeorder') }}", 
		{ '_token': '{{csrf_token()}}', 'link_id': link_id, 'link_order': link_order },
		function (data){
			if( data.status == 0 ){
				layer.msg(data.msg, { icon: 6 });
			}else{
				layer.msg(data.msg, { icon: 5 });
			}
		});
}

// 删除分类
function delLink(link_id){
	layer.confirm('你确定删除这个链接吗？', {
		btn: ['确定', '取消']
	}, function (){
		$.post("{{ url('admin/link/') }}/" +link_id, 
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