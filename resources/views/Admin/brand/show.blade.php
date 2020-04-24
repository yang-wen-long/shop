<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>商品展示页面</title>
</head>
	<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">  
	<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
<body>
	<nav class="navbar navbar-inverse">
	  <div class="container-fluid">
	    <div class="navbar-header">
	      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>                        
	      </button>
	      <a class="navbar-brand" href="javascript:void(0)">微商城</a>
	    </div>
	    <div class="collapse navbar-collapse" id="myNavbar">
	      <ul class="nav navbar-nav">
	        <li class="active"><a href="{{url('/brand/create')}}">商品品牌</a></li>
	        <li><a href="{{url('/cate/category')}}">商品分类</a></li>
	        <li><a href="{{url('/goods')}}">商品管理</a></li>
	        <li><a href="{{url('/admin')}}">管理员管理</a></li>
	        <li><a href="{{url('/area')}}">友情链接</a></li>
	      </ul>
	    </div>
	  </div>
	</nav>
	<center>
		<h2>展示商品 <a href="{{url('/brand/create')}}" style="float:right">添加商品</a></h2>
		<form>
			 <input type="text" name="blog_name" value="{{$blog_name}}" placeholder="请输入商品名称">
			 <input type="submit" value="搜索">
		</form>
		<table border="1">
			<tr>
				<td>商品ID</td>
				<td>商品名称</td>
				<td>品牌网站</td>
				<td>商品LOGO</td>
				<td>商品描述</td>
				<td>操作</td>
			</tr>
			@foreach($user as $error)
			<tr>
				<td>{{$error->blog_id}}</td>
				<td>{{$error->blog_name}}</td>
				<td>{{$error->blog_url}}</td>
				<td>
					<img src="http://uploads.1910.com/{{$error->blog_logo}}" width="100px">
				</td>
				<td>{{$error->blog_desc}}</td>
				<td>
					<a href="{{url('/brand/destroy/'.$error->blog_id)}}">删除</a>||
					<a href="{{url('/brand/edit/'.$error->blog_id)}}">修改</a>
				</td>
			</tr>
			@endforeach
		</table>
		{{$user->appends(['blog_name' => $blog_name])->links()}}
	</center>
</body>
</html>
<script>
// $(document).ready(function(){
// 	$(document).on("click",".page-item a",function(){
// 		var url = $(this).attr("href");
// 		$.get(url,function(index){
// 			$("table").html(index);
// 		});
// 		return false;
// 	});
// });
</script>