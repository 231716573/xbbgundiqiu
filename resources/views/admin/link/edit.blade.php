@extends('layout.admin')

@section('title', '编辑友情链接')


@section('layout.content')
<div class="col-xs-12 col-sm-8 col-md-9 container">
    <div class="row">
	    <h3 class="form-group">编辑友情链接<small class="pull-right"><a class="btn btn-primary" href="{{ url('admin/link') }}">返回</a></small></h3>
		<hr />
        <div class="panel">
            <!-- 主体 -->
			<div class="panel-body">

				<form class="form-horizontal" method="post" action="{{url('admin/link/'.$field->link_id)}}">
					{{method_field('PUT')}}
        			{{csrf_field()}}
					<div class="form-group">
					    <label class="col-sm-2 control-label">名称：</label>
					    <div class="col-sm-7">
					      	<input type="text" value="{{ $field->link_name }}" style="width:150px; display: inline-block;" class="form-control" name="link_name" placeholder="请输入友情链接名称">
					      	<span style="color:red;">　* 友情链接名称不能为空</span>
					    </div>
					</div>
					<div class="form-group">
					    <label class="col-sm-2 control-label">标题：</label>
					    <div class="col-sm-7">
					      	<input type="text" value="{{ $field->link_title }}" class="form-control" name="link_title" placeholder="请输入友情链接英文名">
					    </div>
					</div>
					<div class="form-group">
					    <label class="col-sm-2 control-label">地址：</label>
					    <div class="col-sm-7">
					      	<input type="text" value="{{ $field->link_url }}" class="form-control" name="link_url" placeholder="请输入友情链接地址">
					    </div>
					</div>
					<div class="form-group">
					    <label class="col-sm-2 control-label">排序：</label>
					    <div class="col-sm-7">
					      	<input type="text" value="{{ $field->link_order }}" style="width:150px; display: inline-block;" class="form-control" name="link_order" placeholder="请输入排序">
					      	<span style="color:red;">　* 友情链接的排列顺序</span>
					    </div>
					</div>
					<div class="form-group">
						<div class="col-sm-offset-2 col-sm-9">
					      	<button type="submit" class="btn btn-primary">提交</button>　
					      	<button type="reset" class="btn btn-info">清空</button>
					    </div>
					</div>
					<div class="form-group">
						<div class="col-sm-offset-2 col-sm-9" style="color:red;">
							@if(count($errors)>0)
				                @if(is_object($errors))
				                    @foreach($errors->all() as $error)
				                        <p>{{$error}}</p>
				                    @endforeach
				                @else
				                    <p>{{$errors}}</p>
				                @endif
					        @endif
					    </div>
					</div>
				</form>
				
			</div>
			
        </div>
    </div>
</div>
@endsection