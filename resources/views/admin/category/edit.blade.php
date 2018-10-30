@extends('layout.admin')

@section('title', '添加分类')


@section('layout.content')
<div class="container">
    <div class="row">
        <div class="col-md-7 col-sm-offset-2">
	        	<h3 class="form-group">添加分类<small class="pull-right"><a class="btn btn-primary" href="{{ url('admin/category') }}">返回</a></small></h3>
			<hr />
            <div class="panel">
                <!-- 主体 -->
				<div class="panel-body">

					<form class="form-horizontal" method="post" action="{{ url('admin/category/'.$field->cate_id) }}">
						{{ csrf_field() }}
						<input type="hidden" name="_method" value="put">
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">父级分类</label>
							<div class="col-sm-9">
								<select name="cate_pid" class="form-control">
									<option value="0" class="form-control">--顶级分类--</option>
									@foreach( $data as $d )
									<option value="{{ $d->cate_id }}" {{ $d->cate_id == $field->cate_pid ? 'selected' : '' }} class="form-control">{{ $d->cate_name }}</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="form-group">
						    <label for="cate_name" class="col-sm-2 control-label">分类名称</label>
						    <div class="col-sm-9">
						      	<input type="text" value="{{ $field->cate_name }}" class="form-control" name="cate_name" placeholder="请输入分类名称">
						    </div>
						</div>
						<div class="form-group">
						    <label for="" class="col-sm-2 control-label">分类标题</label>
						    <div class="col-sm-9">
						      	<input type="text" value="{{ $field->cate_title }}" class="form-control" name="cate_title" placeholder="请输入分类标题">
						    </div>
						</div>
						<div class="form-group">
						    <label for="" class="col-sm-2 control-label">关键词</label>
						    <div class="col-sm-9">
						      	<input type="text" value="{{ $field->cate_keywords }}" class="form-control" name="cate_keywords" placeholder="请输入关键词">
						    </div>
						</div>
						<div class="form-group">
						    <label for="" class="col-sm-2 control-label">描述</label>
						    <div class="col-sm-9">
						      	<textarea name="cate_description" class="form-control" rows="4" placeholder="请输入描述">{{ $field->cate_description }}</textarea>
						    </div>
						</div>
						<div class="form-group">
						    <label for="" class="col-sm-2 control-label">排序</label>
						    <div class="col-sm-9">
						      	<input type="text" style="width:100px; display: inline-block;" class="form-control" value="{{ $field->cate_order }}" name="cate_order" placeholder="请输入排序">
						      	<span style="color:red;">　* 分类的排列顺序</span>
						    </div>
						</div>
						<div class="form-group">
							<div class="col-sm-offset-2 col-sm-10">
						      	<button type="submit" class="btn btn-primary">提交</button>　
						      	<button type="reset" class="btn btn-info">清空</button>
						    </div>
						</div>
						<div class="form-group">
							<div class="col-sm-offset-2 col-sm-10" style="color:red;">
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
</div>
@endsection