<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::group(['middleware' => ['web']], function (){
	// 生成验证码
	Route::get('admin/code', 'Admin\LoginController@code');
	// 用户登录
	Route::any('admin/login', 'Admin\LoginController@login');
	// 用户注册
	Route::any('admin/register', 'Admin\LoginController@register');
	// 用户退出
	Route::get('admin/logout', 'Admin\LoginController@logout');

	// 前台首页
	Route::get('/', 'Home\HomeController@index');
	// 前台导航页
	Route::get('/daohang', 'Home\HomeController@daohang');
	// 前台文章页
	Route::get('/article/{art_id}', 'Home\HomeController@article');
	// 前台文章列表页
	Route::get('/category/{cate_id}', 'Home\HomeController@category');
	// 前台日记列表页
	Route::get('/diary', 'Home\HomeController@diary');
	// 前台日记页
	Route::get('/diary/{diary_id}', 'Home\HomeController@diaryview');
});


Route::group([ 'middleware' => ['web', 'admin.login'], 'prefix' => 'admin', 'namespace'=>'Admin'], function (){
	// 上传图片
	Route::any('upload', 'CommonController@upload');
	// 个人资料	
	Route::any('profile', 'IndexController@profile');
	// 忘记密码
	Route::any('lostpsw', 'IndexController@lostpsw');


	// 后台首页
	Route::get('/', 'IndexController@index');
	Route::get('/index', 'IndexController@index');


	// 文章分类 获取分类
	Route::get('cate/getCategory/{type}', 'CategoryController@getCategory');
	// 文章分类
	Route::resource('category', 'CategoryController');
	// 文章分类排序
	Route::post('cate/changeorder', 'CategoryController@changeorder');


	// 文章 获取文章
	Route::get('article/getArticle/{page}', 'ArticleController@getArticle');
	// 文章 获取热门文章
	Route::get('article/getArticle/hot/{art_id}', 'ArticleController@getArticleHot');
	// 文章列表
	Route::resource('article', 'ArticleController');

	// 日记 
	Route::resource('diary', 'DiaryController');

	// nav 前台---导航条
	Route::resource('navs', 'NavsController');
	// nav 导航条排序
	Route::post('navs/changeorder', 'NavsController@changeorder');


	// links 前台---友情链接
	Route::resource('link', 'LinkController');
	// links 友情链接排序
	Route::post('link/changeorder', 'LinkController@changeorder');


	// config 填写config\web.php
	Route::get('config/putfile', 'ConfigController@putFile');
	// config 系统配置
	Route::resource('config', 'ConfigController');
	// config 系统配置排序
	Route::post('config/changeorder', 'ConfigController@changeorder');
	// config 配置内容更新
	Route::post('config/changecontent', 'ConfigController@changecontent');
	
	
});

Route::get('test', 'TestController@index');