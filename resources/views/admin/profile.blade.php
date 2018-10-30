@extends('layout.admin')

@section('title', '个人资料')


@section('layout.content')
<link rel="stylesheet" type="text/css" href="{{asset('uploadify/uploadify.css')}}">
<style type="text/css">
.usersex { margin-right: 5px; }
input[type=radio] { vertical-align: bottom; margin-bottom: 2px; margin-right:  }

.uploadify { display: inline-block; }
.uploadify-button { border:none; border-radius: 5px; margin-top:5px; }
#user_thumb_img { max-width:200px; height:auto; display: block; }
</style>
<div class="container">
    <div class="row">
        <div class="col-md-9">
        	<h3 class="form-group">个人资料<small class="pull-right"></small></h3>
			<hr />
            <div class="panel">
                <!-- 主体 -->
				<div class="panel-body">

					<form class="form-horizontal" method="post" action="">
						{{ csrf_field() }}
						<div class="form-group">
							<label for="user_email" class="col-sm-2 control-label">个人头像</label>
							<div class="col-sm-10">
                          		<input type="text" value="{{ $user->user_thumb }}" class="form-control" name="user_thumb" placeholder="请上传个人头像" style="display: none;">
                          		<img src="/{{ $user->user_thumb }}" id="user_thumb_img">
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
									$("input[name=user_thumb]").val(data);
				            		$('#user_thumb_img').attr("src", '/'+data);
								}
							})
						})
						</script>
						<div class="form-group">
							<label for="user_email" class="col-sm-2 control-label">个人邮箱</label>
							<div class="col-sm-10">
                          		<input type="email" class="form-control" name="user_email" placeholder="请输入个人邮箱" value='{{ $user->user_email }}'>
                        	</div>
						</div>
						<div class="form-group">
							<label for="user_realname" class="col-sm-2 control-label">名字</label>
							<div class="col-sm-10">
                                <input type="text" class="form-control" name="user_realname" placeholder="请输入名字" value='{{ $user->user_realname }}'>
                            </div>
						</div>
						<div class="form-group">
							<label for="user_email" class="col-sm-2 control-label">性别</label>
							<div class="col-sm-10" style="margin-top: 7px;">
                                <label for="boy" class="usersex">
                                	<input type="radio" name="user_sex" value="boy"> 男
                                </label>
                                <label for="girl" class="usersex">
                                	<input type="radio" name="user_sex" value="girl"> 女
                                </label>
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
<script src="{{asset('uploadify/jquery.uploadify.min.js')}}" type="text/javascript"></script>

<script type="text/javascript">
$(function (){
	var userSex = '{{ $user->user_sex }}';
	$(".usersex").each(function (){
		// console.log($(this).children("input").val() + "、" + userSex);
		if( $(this).children("input").val() == userSex ){
			$(this).children("input").attr("checked", "checked");
		}
	})
})
</script>
@endsection