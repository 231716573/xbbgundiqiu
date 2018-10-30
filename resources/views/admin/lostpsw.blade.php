@extends('layout.admin')

@section('title', '修改密码')


@section('layout.content')
<div class="container">
    <div class="row" style="margin-top:100px;">
        <div class="col-md-7 col-sm-offset-2">
            <div class="panel">
                <!-- 主体 -->
				<div class="panel-body">

					<form class="form-horizontal" method="post" action="">
						{{ csrf_field() }}
						<div class="form-group">
							<label for="old_pass" class="col-sm-2 control-label">旧密码</label>
							<div class="col-sm-10">
                          		<input type="password" class="form-control" name="old_pass" placeholder="请输入旧密码" value='{{ session("old_pass") ? session("old_pass") : "" }}'>
                        	</div>
						</div>
						<div class="form-group">
							<label for="user_pass" class="col-sm-2 control-label">新密码</label>
							<div class="col-sm-10">
                                <input type="password" class="form-control" name="new_pass" placeholder="请输入6~20位以上新密码" value=''>
                            </div>
						</div>
						<div class="form-group">
							<label for="new_pass_confirmation" class="col-sm-2 control-label">确定密码</label>
							<div class="col-sm-10">
                                <input type="password" class="form-control" name="new_pass_confirmation" placeholder="请确认新密码" value=''>
                            </div>
						</div>

                      	<div class="form-group">
                      		<div class="col-sm-offset-2 col-sm-10">
								<button type="submit" class="btn btn-primary">提交</button>
								<button type="reset" class="btn btn-info">重置</button>
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