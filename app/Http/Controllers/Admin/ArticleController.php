<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
// 引入 article model
use App\Http\Model\Article;
// 引入 category model
use App\Http\Model\Category;
// input 门面
use Illuminate\Support\Facades\Input;
// 验证
use Illuminate\Support\Facades\Validator;


class ArticleController extends CommonController
{
    // get.admin/article 全部文章列表
    public function index()
    {
    	$cate = (new Category)->tree();

    	$art = Article::leftJoin('blog_category','article.cate_id','=','blog_category.cate_id')->orderBy('art_id', 'desc')->paginate(10);

    	// $art  = Article::orderBy('art_id', 'desc')->paginate(10);

    	return view('admin.article.index', compact('art', 'cate'));
    }


    // get.admin/article/create  添加文章
    public function create()
    {
    	// 引入分类
    	$data = (new Category)->tree();
    	return view('admin.article.add', compact('data'));
    }

    // post.admin/article 添加文章---提交
    public function store()
    {
    	$input = Input::except('_token');
    	// dd($input);

    	$input['art_time'] = time();

    	$rules = [
    		'art_title' => 'required',
    	];

    	$message = [
    		'art_title.required'  => '文章标题不能为空',
    	];

    	$validator = Validator::make($input, $rules, $message);

    	if( $validator->passes() ){
    		// 插入文章
    		$re = Article::create($input);

    		if( $re ){
    			return redirect('admin/article');
    		}else{
    			return back()->with('errors', '新增文章失败，请稍后重试！');
    		}
    	}else{
    		return back()->withErrors($validator);
    	}

    }

    // get.admin/article/{art_id}/edit   修改文章---编辑
    public function edit($art_id)
    {
    	// 引入分类
    	$data = (new Category)->tree();
    	$article = Article::find($art_id);

    	return view('admin.article.edit', compact('data', 'article'));
    }

    // put.admin/article/{art_id}  修改文章---提交
    public function update($art_id)
    {
    	$input = Input::except('_token', '_method');
    	$input['art_time'] = time();

    	$re = Article::where('art_id', $art_id)->update($input);

    	if( $re ){
    		return redirect('admin/article');
    	}else{
    		return back()->with('errors','文章更新失败，请稍后重试！');
    	}
    }


    // delete.admin/article/{{art_id}}  删除文章
    public function destroy($art_id)
    {
    	$re = Article::where('art_id', $art_id)->delete();

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
