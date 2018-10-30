<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
// 引入 category model
use App\Http\Model\Category;
// input 门面
use Illuminate\Support\Facades\Input;
// 验证
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    // get.admin/category 全部分类列表
    public function index()
    {
    	// $data = Category::all();
    	// dd($data);
    	$categorys = (new Category)->tree();

		return view('admin.category.index')->with('data', $categorys);
    }

    // get.admin/category/create  添加分类
    public function create()
    {
    	$data = Category::where("cate_pid", 0)->get();
    	// dd($data);
    	
    	return view('admin.category.add', compact('data'));
    }

    // post.admin/category  添加分类提交
    public function store(Request $request)
    {	
    	$input = Input::except('_token');
    	// dd($input);

    	$rules = [
    		'cate_name' => 'required',
    	];

    	$message = [
    		'cate_name.required' => '分类名称不能为空',
    	];

    	$validator = Validator::make($input, $rules, $message);
    	
    	if( $validator->passes() ){
    		// 新增分类
    		$re = Category::create($input);

	    	if( $re ){
	    		return redirect('admin/category');
	    	}else{
	    		return view('admin.category.add')->with('errors', '分类添加失败，请稍后再试！');
	    	}
    	}else{
    		return view('admin.category.add')->withErrors($validator);
    	}
    }

    // get.admin/category/{$cate_id}/edit  编辑分类
    public function edit($cate_id)
    {
    	$field = Category::find($cate_id);
    	$data  = Category::where('cate_pid', 0)->get();

    	return view('admin.category.edit', compact('data', 'field'));
    }

    // put.admin/category/{category}     更新分类
    public function update(Request $request, $cate_id)
    {	
    	$input = Input::except('_token', '_method');
    	// dd($input);
    	$re = Category::where('cate_id', $cate_id)->update($input);

    	if($re){
    		return redirect('admin/category');
    	}else{
    		return back()->with('errors', '数据更新失败，请稍后再试！');
    	}

    	
    }


    // delete.admin/category/{cate_id}  删除单个分类
    public function destroy($cate_id)
    {
    	$re = Category::where('cate_id', $cate_id)->delete();

    	if( $re ){
    		$data = [
    			'status' => 0,
    			'msg'    => '分类删除成功！',
    		];
    	}else{
    		$data = [
    			'status' => 1,
    			'msg'    => '分类删除失败，请稍后重试！',
    		];
    	}

    	return $data;
    }


    // 分类排序
    public function changeorder(Request $request)
    {
    	$input = $request->input();

    	$cate = Category::find($input['cate_id']);
    	$cate->cate_order = $input['cate_order'];

    	$re = $cate->update();

    	if( $re ){
    		$data = [
    			'status' => 0,
    			'msg'    => '分类排序更新成功',
    		];
    	}else{
    		$data = [
    			'status' => 1,
    			'msg'    => '分类排序失败，请稍后重试',
    		];
    	}

    	return $data;
    }

    // 获取所有分类
    public function getCategory($type){
        switch ($type) {
            case 'first':
                $cate = Category::where('cate_pid', 0)->select(['cate_name'])->get();
                break;

            case 'second':
                $cate = Category::where('cate_pid', '<>', 0)->select(['cate_name'])->get();
                break;

            default:
                $cate = (new Category)->tree();
                break;
        }


        if($cate){
            $cate = [
                'status' => 1,
                'data'   => $cate
            ];
        }else{
            $cate = [
                'status' => 0,
                'data'   => '数据出错！'
            ];
        }

        return $cate;
    }
}
