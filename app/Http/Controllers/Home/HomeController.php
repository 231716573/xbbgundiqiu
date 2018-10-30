<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Model\Article;
use App\Http\Model\Category;
use App\Http\Model\Diary;


class HomeController extends CommonController
{
	// 首页
	public function index()
	{
		$data = Article::orderBy('art_time', 'desc')->take(9)->get();

		$cate = Category::where("cate_pid" , 0)->take(4)->get();

		return view('home.index', compact('data', 'cate'));
	}

	// 导航
	public function daohang()
	{
		return view('home.daohang');
	}

	// 文章列表页
	public function category($cate_id)
	{
		$field = Category::find($cate_id);

		// 图文列表5篇(带分页)
		$data = Article::where('cate_id', $cate_id)->orderBy('art_time', 'desc')->paginate(4);

		// 当前分类的子分类
		$submenu = Category::where('cate_pid', $cate_id)->get();
		// dd($submenu);

		// 查看次数递增
		Category::where('cate_id', $cate_id)->increment('cate_view');

		return view('home.articlelist', compact('hot', 'new', 'field', 'submenu', 'data'));
	}

	// 文章页
	public function article($art_id)
	{
		$field = Article::Join('blog_category', 'article.cate_id', '=', 'blog_category.cate_id')->where('art_id', $art_id)->first();

		// 查看次数自增
		Article::where('art_id', $art_id)->increment('art_view');

		// 上一篇
		$article['pre'] = Article::where('art_id', '<', $art_id)->orderBy('art_id', 'desc')->first();

		// 下一篇
		$article['next']= Article::where('art_id', '>', $art_id)->orderBy('art_id', 'asc')->first();



		// 最新发布的相关类型文章
		$data = Article::where('cate_id', $field->cate_id)->orderBy('art_id', 'desc')->take(5)->get();
		// dd($data);

		return view('home.article', compact('data', 'field', 'article', 'hot'));
	}

	// 日记列表页
	public function diary()
	{
		$data = Diary::orderBy('diary_time', 'desc')->get();

		return view('home.diary', compact('data'));
	}

	// 日记详情页
	public function diaryview($diary_id)
	{
		// 查看次数自增
		Diary::where('id', $diary_id)->increment('diary_view');

		$field = Diary::where('id', $diary_id)->first();

		// 上一篇
		$diary['pre'] = Diary::where('id', '<', $diary_id)->orderBy('id', 'desc')->first();

		// 下一篇
		$diary['next'] = Diary::where('id', '>', $diary_id)->orderBy('id', 'asc')->first();

		return view('home.diaryview', compact('field', 'diary'));
	}
}
