<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
	
use App\Http\Model\Link;

class LinkController extends Controller
{
	// get.admin.links 全部友情链接列表
    public function index()
    {
    	$data = Link::orderBy('link_order', 'asc')->get();
    	return view('admin.link.index', compact('data'));
    }

    // 友情链接排序
    public function changeOrder()
    {
    	$input = Input::all();
    	$link = Link::find($input['link_id']);
    	$link->link_order = $input['link_order'];
    	$re = $link->update();
    	if( $re ){
    		$data = [
    			'status' => 0,
                'msg'    => '友情链接排序更新成功！',
    		];
    	}else{
			$data = [
    			'status' => 1,
                'msg'    => '友情链接排序更新失败，请稍后重试！',
    		];
    	}

    	return $data;
    }
    
    //get.admin/links/create   添加友情链接
    public function create()
    {
    	return view('admin.link.add');
    }

    // post.admin/links   添加友情链接提交
    public function store()
    {
    	$input = Input::except('_token');
    	$rules = [
    		'link_name'  => 'required',
    		'link_url'   => 'required',
    	];

    	$message = [
    		'link_name.required'  => '友情链接名称不能为空！',
    		'link_url.required'   => '友情链接URL不能为空！',
    	];

    	$validator = Validator::make($input, $rules, $message);

    	if( $validator->passes() ){
    		$re = Link::create($input);
    		if( $re ){
    			return redirect('admin/link');
    		}else{
    			return back()->with('errors','友情链接失败，请稍后重试！');
    		}
    	}else{
    		return back()->withErrors($validator);
    	}
    }

    // get.admin/link/{link_id}/edit  编辑友情链接
    public function edit($link_id)
    {
    	$field = Link::find($link_id);
    	return view('admin.link.edit', compact('field'));
    }

    // put.admin/link/{link_id}  更新友情链接
    public function update($link_id)
    {
    	$input = Input::except('_method', '_token');
    	$re = Link::where('link_id', $link_id)->update($input);
    	if( $re ){
    		return redirect('admin/link');
    	}else{
    		return back()->with('errors','友情链接更新失败，请稍后重试！');
    	}
    }

    // delete.admin/link/{link_id}   删除友情链接
    public function destroy($link_id)
    {
    	$re = Link::where('link_id', $link_id)->delete();
    	if($re){
    		$data = [
    			'status' => 0,
    			'msg'    => '友情链接删除成功！',
    		];
    	}else{
    		$data = [
    			'status' => 1,
    			'msg'    => '友情链接删除失败，请稍后重试！',
    		];
    	}

    	return $data;
    }
}
