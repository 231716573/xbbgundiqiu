@extends('layout.admin')

@section('title', '后台首页')


@section('layout.content')
<style type="text/css">
/*.get-flex { display: flex; }*/
.get-flex button { display: inline-block; width: 27%; margin-bottom: 10px; }
</style>
<div class="container">
    <div class="row get-flex">
		<button type="button" class="btn btn-primary" id="get-article">（获取文章数据）Article</button>

		<button type="button" class="btn btn-primary" id="get-article-hot">（获取热门文章）Article-hot</button>
	
		<button type="button" class="btn btn-primary" id="get-category">（获取全部分类）Category</button>

		<button type="button" class="btn btn-primary" id="get-category-first">（获取一级分类）Category-first</button>

		<button type="button" class="btn btn-primary" id="get-category-second">（获取二级分类）Category-second</button>
    </div>
</div>
<script type="text/javascript">
$(function (){
	// 获取文章列表
	var articlePage = 0;
	$("#get-index").bind('click', function (){
		$.get("{{ url('admin/article/getArticle') }}/" + articlePage, function (data){
			if(data.status == 1){
				data = data.data;
				articlePage += 1;
				console.log(articlePage);
				console.log(JSON.stringify(data));
			}else{
				layer.open({
				  	title: '数据出错！',
				  	content: JSON.stringify(data.data)
				}); 
			}
		})
	})

	// 获取热门文章列表
	var artId = 1;
	$('#get-article-hot').bind('click', function (){
		$.get("{{ url('admin/article/getArticle/hot') }}/" + artId, function (data){
			if(data.status == 1){
				data = data.data;
				console.log(JSON.stringify(data));
			}else{
				layer.open({
				  	title: '数据出错！',
				  	content: JSON.stringify(data.data)
				}); 
			}
		})
	})

	// 获取一级分类
	$('#get-category').bind('click', function (){
		$.get("{{ url('admin/cate/getCategory/all') }}", function (data){
			if(data.status == 1){
				data = data.data;
				console.log(JSON.stringify(data));
			}else{
				layer.open({
				  	title: '数据出错！',
				  	content: JSON.stringify(data.data)
				}); 
			}
		})
	})

	// 获取一级分类
	$('#get-category-first').bind('click', function (){
		$.get("{{ url('admin/cate/getCategory/first') }}", function (data){
			if(data.status == 1){
				data = data.data;
				console.log(JSON.stringify(data));
			}else{
				layer.open({
				  	title: '数据出错！',
				  	content: JSON.stringify(data.data)
				}); 
			}
		})
	})

	// 获取二级分类
	$('#get-category-second').bind('click', function (){
		$.get("{{ url('admin/cate/getCategory/second') }}", function (data){
			if(data.status == 1){
				data = data.data;
				console.log(JSON.stringify(data));
			}else{
				layer.open({
				  	title: '数据出错！',
				  	content: JSON.stringify(data.data)
				}); 
			}
		})
	})
})
</script>
@endsection