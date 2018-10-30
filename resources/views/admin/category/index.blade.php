@extends('layout.admin')

@section('title', '分类列表')


@section('layout.content')
<style type="text/css">
.table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th { vertical-align: middle; text-align: center; }
</style>
<div class="col-xs-12 col-sm-9 col-md-10 container">
	<h3 class="form-group">分类列表<small class="pull-right"><a class="btn btn-primary" href="{{ url('admin/category/create') }}">添加分类</a></small></h3>
	<hr />
    <table class="table table-bordered">
        <thead>
            <tr class="info">
            	<th style="width:80px;">排序</th>
                <th style="width:70px;">ID</th>
                <th style="width:150px;">分类</th>
                <th>标题</th>
                <th style="width:120px;">查看次数</th>
                <th style="width:120px;">操作</th>
            </tr>
        </thead>
        <tbody>
        @foreach( $data as $d )
            <tr>
                <td>
                	<input type="text" onchange="changeOrder(this, {{$d->cate_id}})" value="{{ $d->cate_order }}" style="width:40px; padding:3px 5px;">
                </td>
                <td>{{ $d->cate_id }}</td>
                <td style="text-align:left;">
					<a href="javascript:void(0);">{{ $d->_cate_name }}</a>
                </td>
                <td style="text-align:left;">{{ $d->cate_title }}</td>
                <td>{{ $d->cate_view }}</td>
                <td>
                    <a href="{{ url('admin/category/'. $d->cate_id .'/edit') }}">修改</a>
                    <a href="javascript:void(0);" onclick="delCate({{ $d->cate_id }})">删除</a>
                </td>
            </tr>
		@endforeach
        </tbody>
    </table>
</div>

<script type="text/javascript">
function changeOrder(obj, cate_id){
	var cate_order = $(obj).val();
	$.post("{{ url('admin/cate/changeorder') }}", 
		{ '_token': '{{csrf_token()}}', 'cate_id': cate_id, 'cate_order': cate_order },
		function (data){
			if( data.status == 0 ){
				layer.msg(data.msg, { icon: 6 });
			}else{
				layer.msg(data.msg, { icon: 5 });
			}
		});
}

// 删除分类
function delCate(cate_id){
	layer.confirm('你确定删除这个分类吗？', {
		btn: ['确定', '取消']
	}, function (){
		$.post("{{ url('admin/category/') }}/" +cate_id, 
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