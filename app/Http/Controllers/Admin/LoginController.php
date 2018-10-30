<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
// 对接user model
use App\Http\Model\User;


// 验证
use Illuminate\Support\Facades\Validator;
// 加密
use Illuminate\Support\Facades\Crypt;
// input 门面
use Illuminate\Support\Facades\Input;


// 引入外部文件
require (app_path() . '/code/Code.class.php');

class LoginController extends CommonController
{
	// 生成验证码
	public function code()
	{
        session_start();
		$code = new \Code;
		$abc = $code->make();
	}

	// 用户登录
    public function login(Request $request)
    {
    	if( $request->isMethod('get') ){

    		return view('admin.login');

    	}else{
            session_start();
            $input = Input::except('_token');
            // dd($input);

            $code = new \Code;
            $_code = $code->get();

            // 验证验证码
            if( strtoupper($input['code']) != $_code ){
                return view('admin.login')->with('errors','验证码错误！');
            }
            // 获取数据库对应用户
            $user = User::where('user_name', $input['user_name'])->first();

            if( $user == null ){
                return view('admin.login')->with('errors','用户不存在');
            }else{
                // dd($user->user_password);
                if( $user->user_password != $input['user_pass']){
                    $request->session()->flash('user_name', $request->input('user_name'));
                    return view('admin.login')->with('errors','密码错误！');
                }
            }

            // 储存数据
            session(['user'=>$user]);
            // 跳转到后台首页
            return redirect('admin/index');
    	}

    }

    // 用户注册
    public function register(Request $request)
    {
    	if( $request->isMethod('get') ){
    		return view('admin.register');
    	}else{

    		// dd($request->input());
    		$rules = [
    			'user_name' => 'required',
    			'user_pass' => 'required|between:6,20|confirmed',
    		];

    		$message = [
    			'user_name.required'    => '用户名不能为空',
    			'user_pass.required'    => '密码不能为空',
                'user_pass.between'     => '密码请在6~12位之间',
                'user_pass.confirmed'   => '密码和确认密码不一致！',
    		];

    		// 验证数据
    		$validator = Validator::make($request->input(), $rules, $message);

    		if( $validator->passes() ){
                session_start();
                $input = Input::except('_token');

                $code = new \Code;
                $_code = $code->get();
                // dd($_code);
                
                // 验证验证码
                if( strtoupper($input['code']) != $_code ){
                    $request->session()->flash('user_name', $request->input('user_name'));
                    $request->session()->flash('user_pass', $request->input('user_pass'));
                    $request->session()->flash('user_pass_confirmation', $request->input('user_pass_confirmation'));
                    return view('admin.register')->with('errors','验证码错误！');
                }
                
                // 检验用户是否已存在
                $find_user = User::where('user_name', $request->input('user_name'))->first();

                if( $find_user ){
                    $request->session()->flash('user_name', $request->input('user_name'));
                    $request->session()->flash('user_pass', $request->input('user_pass'));
                    return view('admin.register')->with('errors','用户已存在！');
                }else{

                    // 插入数据
                    $re = User::create([
                        'user_name' => $request->input('user_name'), 
                        'user_password' => $request->input('user_pass'),
                    ]);

                    // 插入成功
                    if( $re ){
                        return redirect('admin/login');
                    // 插入成功
                    }else{
                        return view('admin.register')->with('errors','数据填充失败，请稍后重试！');
                    }
                }

    		}else{
    			// dd($validator->errors()->all());
    			return view('admin.register')->withErrors($validator);

    		}
    	}

    }

    // 用户退出
    public function logout()
    {
        // dd("退出成功");
        session(['user'=>null]);
        return redirect('admin/login');
    }
}
