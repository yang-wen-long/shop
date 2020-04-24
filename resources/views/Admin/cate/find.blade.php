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
		<h2>展示分类 <a href="{{url('/cate/category')}}">分类添加</a></h2>
		<table border="1">
			<tr>
				<td>分类ID</td>
				<td>分类名称</td>
				<td>是否显示</td>
				<td>是否导航展示</td>
				<td>商品描述</td>
				<td>操作</td>
			</tr>
			@foreach($user as $error)
			<tr>
				<td>{{$error->cate_id}}</td>
				<td>{{str_repeat('|-',$error->level)}}{{$error->cate_name}}</td>
				<td>{{$error->is_show == 1 ? '是' : '否' }}</td>
				<td>{{$error->is_show_nav ==1 ? '是' : '否' }}</td>
				<td>{{$error->cate_desc}}</td>
				<td>
					<a href="{{url('/cate/destroy/'.$error->cate_id)}}">删除</a>||
					<a href="{{url('/cate/edit/'.$error->cate_id)}}">修改</a>
				</td>
			</tr>
			@endforeach
		</table>
	</center>
</body>
</html>