<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

// 对接user model
use App\Http\Model\User;

// 验证
use Illuminate\Support\Facades\Validator;
// input 门面
use Illuminate\Support\Facades\Input;

class IndexController extends CommonController
{
	// 后台首页
    public function index()
    {
    	return view('admin.index');
    }

    // 修改密码
    public function lostpsw(Request $request){
    	if( $request->isMethod('get') ){
    		return view('admin.lostpsw');
    	}else{
    		$input = Input::all();
    		// dd($input);
    		$rules = [
    			'new_pass'=>'required|between:6,20|confirmed',
    		];
            
    		
    		// dd($user->user_name);

    		$message = [
    			'new_pass.required'  => '新密码不能为空！',
    			'new_pass.between'   => '新密码必须在6-20位之间！',
    			'new_pass.confirmed' => '新密码和确认密码不一致！',
    		];

    		$validator = Validator::make($input, $rules, $message);

    		if($validator->passes()){
    			$sessionUser = $request->session()->get('user');

    			$user = User::where('user_name', $sessionUser->user_name)->first();

    			if( $user->user_password != $input['old_pass']){
    				return view('admin.lostpsw')->with('errors','旧密码错误！');
    			}else{

    				$user->update(['user_password' => $input['new_pass']]);
    				return view('admin.lostpsw')->with('errors','密码修改成功！');
    			}

    		}else{
    			return view('admin.lostpsw')->withErrors($validator);
    		}
    	}

    }

    // 个人资料
    public function profile(Request $request){
    	if( $request->isMethod('get') ){
    		$sessionUser = $request->session()->get('user');
    		$user = User::where('user_name', $sessionUser->user_name)->first();
    		// dd($user);
    		
    		return view('admin.profile', compact('user'));

    	}else{
    		$input = Input::except('_token');

    		$sessionUser = $request->session()->get('user');
    		// dd($sessionUser->user_name);

    		$re   = User::where('user_name', $sessionUser->user_name)->update($input);
    		$user = User::where('user_name', $sessionUser->user_name)->first();
    		// 储存新数据
            session(['user'=>$user]);

    		if( $re ){
    			return view('admin.profile', compact('user'))->with('errors','个人资料修改成功！');
    		}else{
    			return view('admin.profile', compact('user'))->with('errors','个人资料修改失败！');
    		}
    		
    	}

    }
}
