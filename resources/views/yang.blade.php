<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>新闻列表展示</title>
</head>
	<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">  
	<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<meta name="csrf-token" content="{{ csrf_token() }}">
<body>
	<center>
			<h2><font color=red>新闻展示页面</font></h2>
		<form>
	新闻名称:<input type="text" name="area_name" value="{{$area_name}}">
	新闻类型: <input type="radio" name="area_data" value="1" {{$area_data == 1 ? "checked" : ""}}>LOGO新闻
			  <input type="radio" name="area_data" value="2" {{$area_data == 2 ? "checked" : ""}}>新闻分享
			<input type="submit" value="搜索">
		</form>
		<table>
			<thead>
				<th>新闻ID</th>
				<th>新闻名称</th>
				<th>新闻网址</th>
				<th>新闻类型</th>
				<th>新闻LOGO</th>
				<th>新闻联系人</th>
				<th>新闻介绍</th>
				<th>是否显示</th>
				<th>操作</th>
			</thead>
		    <tbody>
				@foreach($post as $error)
				<tr>
					<td>{{$error->area_id}}</td>
					<td>{{$error->area_name}}</td>
					<td>{{$error->area_website}}</td>
					<td>{{$error->area_data == 1 ? "LOGO新闻" : "新闻分享"}}</td>
					<td>
						<img src="http://uploads.1910.com/{{$error->area_img}}" width="100px">
					</td>
					<td>{{$error->area_linkman}}</td>
					<td>{{$error->area_text}}</td>
					<td>{{$error->is_desc == 1 ? "√" : "×"}}</td>
					<td>
						<a href="javascript:void(0);" id="delete" class="{{url('/area/destroy/'.$error->area_id)}}">删除</a>
						<a href="">修改</a>
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