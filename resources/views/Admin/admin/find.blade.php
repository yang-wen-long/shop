<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>管理员添加页面</title>
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
			<h2>管理员管理  <a href="{{url('/admin/index')}}">管理员展示</a></h2>
		<form action="{{url('/admin/update/'.$all->admin_id)}}" method="post">
			@csrf
			<table border="1">
				<tr>
					<td>管理员名称</td>
					<td>
						<input type="text" name="admin_name" value="{{$all['admin_name']}}" placeholder="管理员名称">
					</td>
				</tr>
				<tr>
					<td>手机号</td>
					<td>
						<input type="text" name="admin_mobile" value="{{$all['admin_mobile']}}" placeholder="手机号">
					</td>
				</tr>
				<tr>
					<td>邮箱</td>
					<td>
						<input type="text" name="admin_mailbox" value="{{$all['admin_mailbox']}}" placeholder="邮箱">
					</td>
				</tr>
				<tr>
					<td>密码</td>
					<td>
						<input type="password" name="admin_pwd" value="{{decrypt($all['admin_pwd'])}}" placeholder="密码">
					</td>
				</tr>
				<tr>
					<td></td>
					<td>
						<input type="submit" value="提交">
					</td>
				</tr>
			</table>
		</form>
	</center>
</body>
</html>