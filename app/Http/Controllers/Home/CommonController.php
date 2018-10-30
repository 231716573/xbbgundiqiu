<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\View;

use App\Http\Model\Navs;
use App\Http\Model\Article;

class CommonController extends Controller
{
	public function __construct()
	{
		// 获取导航栏
		$navs = Navs::orderBy('nav_order', 'asc')->get();

		// 点击最高的5片文章
		$hot = Article::orderBy('art_view', 'desc')->take(5)->get();

		// 最新发布文章 8篇
		$new = Article::orderBy('art_time', 'desc')->take(5)->get();

		View::share('navs', $navs);
		View::share('hot',  $hot);
		View::share('new',  $new);
	}
}


