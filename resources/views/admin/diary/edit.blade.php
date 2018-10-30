@extends('layout.admin')

@section('title', '修改文章')


@section('layout.content')
<script type="text/javascript" charset="utf-8" src="{{ asset('editor/ueditor.config.js') }}"></script>
<script type="text/javascript" charset="utf-8" src="{{ asset('editor/ueditor.all.min.js') }}"> </script>
<script type="text/javascript" charset="utf-8" src="{{ asset('editor/lang/zh-cn/zh-cn.js') }}"></script>
<script src="{{ asset('uploadify/jquery.uploadify.min.js') }}" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="{{ asset('uploadify/uploadify.css') }}">
<style type="text/css">
.uploadify { display: inline-block; }
.uploadify-button { border:none; border-radius: 5px; margin-top:5px; }
</style>
<div class="container">
    <div class="row">
        <div class="col-md-10 col-xs-12 col-sm-9">
	        <h3 class="form-group">修改文章<small class="pull-right"><a class="btn btn-primary" href="{{ url('admin/diary') }}">返回</a></small></h3>
			<hr />
            <div class="panel">
                <!-- 主体 -->
				<div class="panel-body">

					<form class="form-horizontal" method="post" action="{{ url('admin/diary/'. $diary->id ) }}">
						{{ csrf_field() }}
						<input type="hidden" name="_method" value="put">
						<input type="hidden" name="diary_editor" value="{{ session('user.user_name') }}">
						<div class="form-group">
						    <label class="col-sm-2 control-label">标题：</label>
						    <div class="col-sm-10">
						      	<input type="text" class="form-control" name="diary_title" placeholder="请输入文章标题" value="{{ $diary->diary_title }}"><span style="color:red;">* 标题绝对不能为空，否则提交失败</span>
						    </div>
						</div>
						<div class="form-group">
						    <label class="col-sm-2 control-label">缩略图：</label>
						    <div class="col-sm-10">
                          		<input type="text" value="{{ $diary->diary_thumb }}" class="form-control" name="diary_thumb" placeholder="请上传个人头像" style="display: none;">
                          		<img src="/{{ $diary->diary_thumb }}" alt="缩略图" id="diary_thumb_img">
		      					<input id="file_upload" type="file" multiple="true">
                        	</div>
						</div>
						<!-- 上传图片 -->
						<script type="text/javascript">
						<?php $timestamp = time(); ?>
						$(function() {
							$('#file_upload').uploadify({
								'buttonText' : '上传图片',
								'formData'     : {
									'timestamp' : '<?php echo $timestamp;?>',
									'_token'     : "{{csrf_token()}}"
								},
								'swf'      : "{{ asset('uploadify/uploadify.swf') }}",
								'uploader' : "{{ url('admin/upload') }}",
								'onUploadSuccess' : function(file, data, response){
									$("input[name=diary_thumb]").val(data);
				            		$('#diary_thumb_img').attr("src", '/'+data);
								}
							})
						})
						</script>

						<div class="form-group">
						    <label class="col-sm-2 control-label">关键词：</label>
						    <div class="col-sm-10">
						      	<input type="text" class="form-control" name="diary_tag" placeholder="请输入关键词" value="{{ $diary->diary_tag }}">
						    </div>
						</div>
						<div class="form-group">
						    <label class="col-sm-2 control-label">描述：</label>
						    <div class="col-sm-10">
						      	<textarea name="diary_description" class="form-control" rows="4" placeholder="请输入描述">{{ $diary->diary_description }}</textarea>
						    </div>
						</div>
						<div class="form-group">
						    <label class="col-sm-2 control-label">文章内容：</label>
						    <div class="col-sm-10">
						      	<script name="diary_content" id="editor" type="text/plain" style="height:500px;">{!! $diary->diary_content !!}</script>
						    </div>
						</div>
						<div class="form-group">
							<div class="col-sm-offset-2 col-sm-10">
						      	<button type="submit" class="btn btn-primary">提交</button>
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
<script type="text/javascript">
var ue = UE.getEditor('editor');
</script>
@endsection