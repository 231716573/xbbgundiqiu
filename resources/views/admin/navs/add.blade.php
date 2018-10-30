@extends('layout.admin')

@section('title', '添加自定义导航')


@section('layout.content')
<div class="col-xs-12 col-sm-8 col-md-9 container">
    <div class="row">
	    <h3 class="form-group">添加自定义导航<small class="pull-right"><a class="btn btn-primary" href="{{ url('admin/navs') }}">返回</a></small></h3>
		<hr />
        <div class="panel">
            <!-- 主体 -->
			<div class="panel-body">

				<form class="form-horizontal" method="post" action="{{ url('admin/navs') }}">
					{{ csrf_field() }}
					<div class="form-group">
					    <label class="col-sm-2 control-label">导航名称：</label>
					    <div class="col-sm-7">
					      	<input type="text" style="width:150px; display: inline-block;" class="form-control" name="nav_name" placeholder="请输入导航名称">
					      	<span style="color:red;">　* 导航名称不能为空</span>
					    </div>
					</div>
					<div class="form-group">
					    <label class="col-sm-2 control-label">导航英文名：</label>
					    <div class="col-sm-7">
					      	<input type="text" class="form-control" name="nav_alias" placeholder="请输入导航英文名">
					    </div>
					</div>
					<div class="form-group">
					    <label class="col-sm-2 control-label">导航地址：</label>
					    <div class="col-sm-7">
					      	<input type="text" class="form-control" name="nav_url" placeholder="请输入导航地址">
					    </div>
					</div>
					<div class="form-group">
					    <label class="col-sm-2 control-label">排序：</label>
					    <div class="col-sm-7">
					      	<input type="text" style="width:150px; display: inline-block;" class="form-control" name="nav_order" placeholder="请输入排序">
					      	<span style="color:red;">　* 导航的排列顺序</span>
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