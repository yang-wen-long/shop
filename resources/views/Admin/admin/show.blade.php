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
		<h2>展示商品 <a href="{{url('/admin')}}">添加商品</a></h2>
		<table border="1">
			<tr>
				<td>管理员ID</td>
				<td>管理员名称</td>
				<td>手机号</td>
				<td>邮箱</td>
				<td>密码</td>
				<td>时间</td>
				<td>操作</td>
			</tr>
			@foreach($all as $error)
			<tr>
				<td>{{$error->admin_id}}</td>
				<td>{{$error->admin_name}}</td>
				<td>{{$error->admin_mobile}}</td>
				<td>{{$error->admin_mailbox}}</td>
				<td>{{decrypt($error->admin_pwd)}}</td>
				<td>{{date("Y-m-d H:i:s",$error->admin_time)}}</td>
				<td>
					<a href="{{url('/admin/destroy/'.$error->admin_id)}}">删除</a>
					<a href="{{url('/admin/edit/'.$error->admin_id)}}">修改</a>
				</td>
			</tr>
			@endforeach
		</table>
		{{$all->links()}}
	</center>
</body>
</html>