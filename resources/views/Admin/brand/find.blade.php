<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>商品修改页面</title>
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
			<h2>商品修改  <a href="{{url('/brand/index')}}">展示商品</a></h2>
		<form action="{{url('/brand/update/'.$error->blog_id)}}" method="post" enctype="multipart/form-data">
			@csrf
			<table border="1">
				<tr>
					<td>商品名称</td>
					<td>
						<input type="text" name="blog_name" value="{{$error->blog_name}}" placeholder="商品名称">
						<b style="color:red;">{{$errors->first("blog_name")}}</b>
					</td>
				</tr>
				<tr>
					<td>品牌网站</td>
					<td>
						<input type="text" name="blog_url" value="{{$error->blog_url}}" placeholder="品牌网站">
						<b style="color:red;">{{$errors->first("blog_url")}}</b>
					</td>
				</tr>
				<tr>
					<td>品牌LOGO</td>
					<td>
						<img src="http://uploads.1910.com/{{$error->blog_logo}}" width="50px"><input type="file" name="blog_logo">
					</td>
				</tr>
				<tr>
					<td>商品描述</td>
					<td>
						<textarea name="blog_desc" cols="30" rows="10" placeholder="商品描述">{{$error->blog_desc}}</textarea>
					</td>
				</tr>
				<tr>
					<td></td>
					<td>
						<input type="submit" value="修改">
					</td>
				</tr>
			</table>
		</form>
	</center>
</body>
</html>