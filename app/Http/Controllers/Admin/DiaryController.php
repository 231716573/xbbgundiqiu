<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
// 引入 article model
use App\Http\Model\Diary;
// input 门面
use Illuminate\Support\Facades\Input;
// 验证
use Illuminate\Support\Facades\Validator;


class DiaryController extends CommonController
{
    // get.admin/diary 全部文章列表
    public function index()
    {
    	
    	$diary  = Diary::orderBy('id', 'desc')->paginate(5);

        // dd($art);

    	return view('admin.diary.index', compact('diary'));
    }


    // get.admin/diary/create  添加文章
    public function create()
    {
    	
    	return view('admin.diary.add');
    }

    // post.admin/diary 添加文章---提交
    public function store()
    {
    	$input = Input::except('_token');
    	// dd($input);

    	$input['diary_time'] = time();

    	$rules = [
    		'diary_title' => 'required',
    	];

    	$message = [
    		'diary_title.required'  => '日记标题不能为空',
    	];

    	$validator = Validator::make($input, $rules, $message);

    	if( $validator->passes() ){
    		// 插入文章
    		$re = Diary::create($input);

    		if( $re ){
    			return redirect('admin/diary');
    		}else{
    			return back()->with('errors', '新增日记失败，请稍后重试！');
    		}
    	}else{
    		return back()->withErrors($validator);
    	}

    }

    // get.admin/diary/{id}/edit   修改文章---编辑
    public function edit($diary_id)
    {
    	$diary = Diary::find($diary_id);
        // dd($diary);

    	return view('admin.diary.edit', compact('diary'));
    }

    // put.admin/article/{diary_id}  修改文章---提交
    public function update($diary_id)
    {
    	$input = Input::except('_token', '_method');
    	$input['diary_time'] = time();

    	$re = Diary::where('id', $diary_id)->update($input);

    	if( $re ){
    		return redirect('admin/diary');
    	}else{
    		return back()->with('errors','日记更新失败，请稍后重试！');
    	}
    }


    // delete.admin/article/{{art_id}}  删除文章
    public function destroy($diary_id)
    {
    	$re = Diary::where('id', $diary_id)->delete();

    	if( $re ){
    		$data = [
    			'status'  => 0,
    			'msg'     => '文章删除成功！',
    		];
    	}else{
			$data = [
    			'status'  => 1,
    			'msg'     => '文章删除失败！',
    		];
    	}

    	return $data;
    }




    public function getArticle($page)
    {

        $art = Article::orderBy('art_id', 'desc')->skip($page)->take(1)->get();

        if($art){
            $data = [
                'status' => 1,
                'data'   => $art
            ];
        }else{
            $data = [
                'status' => 0,
                'data'   => '数据出错！'
            ];
        }

        return $data;
    }

    public function getArticleHot($art_id)
    {
        $field = Article::Join('blog_category', 'article.cate_id', '=', 'blog_category.cate_id')->where('art_id', $art_id)->first();

        // 最新发布的相关类型文章
        $art = Article::where('cate_id', $field->cate_id)->where('art_id', '<>', $art_id)->orderBy('art_id', 'desc')->take(4)->get();

        if($art){
            $data = [
                'status' => 1,
                'data'   => $art
            ];
        }else{
            $data = [
                'status' => 0,
                'data'   => '数据出错！'
            ];
        }

        return $data;
    }

}
