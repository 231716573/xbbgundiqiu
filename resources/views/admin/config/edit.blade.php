@extends('layout.admin')

@section('title', '添加系统配置')


@section('layout.content')
<style type="text/css">	
input[type=radio] { vertical-align: middle; margin-bottom: 5px; }
</style>
<div class="col-xs-12 col-sm-8 col-md-9 container">
    <div class="row">
	    <h3 class="form-group">添加系统配置<small class="pull-right"><a class="btn btn-primary" href="{{ url('admin/config') }}">返回</a></small></h3>
		<hr />
        <div class="panel">
            <!-- 主体 -->
			<div class="panel-body">

				<form class="form-horizontal" method="post" action="{{url('admin/config/'.$field->config_id)}}">
					{{method_field('PUT')}}
					{{ csrf_field() }}
					<div class="form-group">
					    <label class="col-sm-2 control-label">标题：</label>
					    <div class="col-sm-8">
					      	<input type="text" value="{{ $field->config_title }}" style="width:250px; display: inline-block;" class="form-control" name="config_title" placeholder="请输入配置名称">
					      	<span style="color:red;">　* 配置标题不能为空</span>
					    </div>
					</div>
					<div class="form-group">
					    <label class="col-sm-2 control-label">名称：</label>
					    <div class="col-sm-8">
					      	<input type="text" value="{{ $field->config_name }}" style="width:250px; display: inline-block;" class="form-control" name="config_name" placeholder="请输入配置名称">
					      	<span style="color:red;">　* 配置名称不能为空</span>
					    </div>
					</div>
					<div class="form-group">
					    <label class="col-sm-2 control-label">类型：</label>
					    <div class="col-sm-8" style="padding-top: 7px;">
					    	<input type="radio" class="radio-inline" name="field_type" value="input" onclick="showTr()" @if($field->field_type=='input') checked @endif > input　
					    	<input type="radio" class="radio-inline" name="field_type" value="textarea" onclick="showTr()" @if($field->field_type=='textarea') checked @endif> textarea　
					    	<input type="radio" class="radio-inline" name="field_type" value="radio" onclick="showTr()" @if($field->field_type=='radio') checked @endif> radio　
					      	<span style="color:#EE6363;">　* 类型: input、textarea、radio</span>
					    </div>
					</div>
					<div class="form-group field_value" style="display: none;">
					    <label class="col-sm-2 control-label">类型值：</label>
					    <div class="col-sm-8">
					      	<input type="text" class="form-control" value="{{ $field->field_value }}" name="field_value" placeholder="请输入类型值">
					      	<span style="color: #EE6363;">类型值只有在radio的情况下才需要配置，格式：1|开启，0|关闭</span>
					    </div>
					</div>
					<div class="form-group">
					    <label class="col-sm-2 control-label">排序：</label>
					    <div class="col-sm-8">
					      	<input type="text" value="{{ $field->config_order }}" style="width:250px; display: inline-block;" class="form-control" name="config_order" placeholder="请输入排序">
					      	<span style="color: #EE6363;">　配置的排列顺序</span>
					    </div>
					</div>
					<div class="form-group">
					    <label class="col-sm-2 control-label">说明：</label>
					    <div class="col-sm-8">
					    	<textarea name="config_content" class="form-control" rows="4" placeholder="请输入说明">{{ $field->config_content }}</textarea>
					    </div>
					</div>
					<div class="form-group">
						<div class="col-sm-offset-2 col-sm-8">
					      	<button type="submit" class="btn btn-primary">提交</button>　
					      	<button type="reset" class="btn btn-info">恢复</button>
					    </div>
					</div>
					<div class="form-group">
						<div class="col-sm-offset-2 col-sm-8" style="color:red;">
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
<script type="text/javascript">
showTr();
function showTr(){
	var type = $('input[name=field_type]:checked').val();

	if( type == 'radio' ){
		$(".field_value").show();
	}else{
		$(".field_value").hide();
	}
}
</script>
@endsection