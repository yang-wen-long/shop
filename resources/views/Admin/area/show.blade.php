<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>商品展示页面</title>
</head>
	<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">  
	<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<meta name="csrf-token" content="{{ csrf_token() }}">
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
		<h2>展示分类 <a href="{{url('/area/')}}">分类添加</a></h2>
		<form>
	网站名称:<input type="text" name="area_name" value="{{$area_name}}">
	网站类型: <input type="radio" name="area_data" value="1" {{$area_data == 1 ? "checked" : ''}}>LOGO阅读
			  <input type="radio" name="area_data" value="2" {{$area_data == 2 ? "checked" : ''}}>文件分享
			<input type="submit" value="搜索">
		</form>
		<table>
			<thead>
				<th>网站ID</th>
				<th>网站名称</th>
				<th>网站网址</th>
				<th>网站类型</th>
				<th>网站LOGO</th>
				<th>网站联系人</th>
				<th>网站介绍</th>
				<th>是否显示</th>
				<th>操作</th>
			</thead>
		    <tbody>
				@foreach($post as $error)
				<tr>
					<td>{{$error->area_id}}</td>
					<td>{{$error->area_name}}</td>
					<td>{{$error->area_website}}</td>
					<td>{{$error->area_data == 1 ? "LOGO阅读" : "文件分享"}}</td>
					<td>
						<img src="http://uploads.1910.com/{{$error->area_img}}" width="100px">
					</td>
					<td>{{$error->area_linkman}}</td>
					<td>{{$error->area_text}}</td>
					<td>{{$error->is_desc == 1 ? "√" : "×"}}</td>
					<td>
						<a href="javascript:void(0);" id="delete" class="{{url('/area/destroy/'.$error->area_id)}}">删除</a>
						<a href="{{url('/area/edit/'.$error->area_id)}}">修改</a>
					</td>
				</tr>
				@endforeach
				<tr>
					<td colspan="14">
						{{$post->appends(["area_name"=>$area_name,"$area_data"=>$area_data])->links()}}
					</td>
				</tr>
		 </tbody>
		</table>
	</center>
</body>
</html>
<script>
	$(document).ready(function(){
		//删除方法
		$(document).on("click","#delete",function(){
			var url = $(this).attr("class");
			$.get(url,function(index){
				$("table").html(index);
			});
		});
		//及点击该

		//无刷新页面分页
		$(document).on("click",".page-item a",function(){
			var url = $(this).attr("href");
			$.get(url,function(index){
				$("table").html(index);
			});
			return false;
		});
	});
</script>