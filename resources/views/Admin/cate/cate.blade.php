<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>商品分类添加</title>
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
			<h2>分类添加  <a href="{{url('/cate/index')}}">展示分类</a></h2>
		<form action="{{url('/cate/store')}}" method="post">
			@csrf
			<table border="1">
				<tr>
					<td> 分类名称 </td>
					<td>
						<input type="text" name="cate_name" placeholder="分类名称">
						<b style="color:red;">{{$errors->first("cate_name")}}</b>
					</td>
				</tr>
				<tr>
					<td> 父级分类 </td>
					<td>
						<select name="parent_id" id="">
							<option value="0">—请选择顶级分类—</option>
							@foreach($res as $kk)
							<option value="{{$kk->cate_id}}">{{str_repeat('|——',$kk->level)}}{{$kk->cate_name}}</option>
							@endforeach
						</select>
					</td>
				</tr>
				<tr>
					<td> 分类描述 </td>
					<td>
						<textarea name="cate_desc" cols="25" rows="7" placeholder="分类描述"></textarea>
						<b style="color:red;">{{$errors->first("cate_desc")}}</b>
					</td>
				</tr>
				<tr>
					<td> 是否导航展示 </td>
					<td>
						<input type="radio" name="is_show_nav" value="1" checked>是
						<input type="radio" name="is_show_nav" value="2">否
					</td>
				</tr>
				<tr>
					<td> 是否显示 </td>
					<td>
						<input type="radio" name="is_show" value="1" checked>是
						<input type="radio" name="is_show" value="2">否
					</td>
				</tr>
				<tr>
					<td>操作</td>
					<td>
						<input type="submit" value="提交">
					</td>
				</tr>
			</table>
		</form>
	</center>
</body>
</html>
