<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>友情链接添加页面</title>
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
			<h2>友情链接修改  </h2> <h3><a href="{{url('/area/index')}}">友情链接展示</a></h3>
		<form action="{{url('/area/update/'.$post->area_id)}}" method="post" enctype="multipart/form-data">
			@csrf
			<table border="1">
				<tr>
					<td>网站名称</td>
					<td>
						<input type="text" name="area_name" value="{{$post->area_name}}" placeholder="网站名称">
						<b style="color:red;">{{$errors->first("area_name")}}</b>
					</td>
				</tr>
				<tr>
					<td>网站网址</td>
					<td>
						<input type="text" name="area_website" value="{{$post->area_website}}" placeholder="网站网址">
						<b style="color:red;">{{$errors->first("area_website")}}</b>
					</td>
				</tr>
				<tr>
					<td>网站类型</td>
					<td>
						<input type="radio" name="area_data" value="1" {{$post->area_data == 1 ? 'checked' : ''}}>LOGO阅读
						<input type="radio" name="area_data" value="2" {{$post->area_data == 2 ? 'checked' : ''}}>文件分享
						<b style="color:red;">{{$errors->first("area_data")}}</b>
					</td>
				</tr>
				<tr>
					<td>网站LOGO</td>
					<td>
						<img src="http://uploads.1910.com/{{$post->area_img}}" width="50px">
						<input type="file" name="area_img">
						<b style="color:red;">{{$errors->first("area_img")}}</b>
					</td>
				</tr>
				<tr>
					<td>网站联系人</td>
					<td>
						<input type="text" name="area_linkman" value="{{$post->area_linkman}}" placeholder="网站联系人">
						<b style="color:red;">{{$errors->first("area_linkman")}}</b>
					</td>
				</tr>
				<tr>
					<td>网站介绍</td>
					<td>
						<textarea name="area_text" placeholder="网站介绍" cols="30" rows="10">{{$post->area_text}}</textarea>
						<b style="color:red;">{{$errors->first("area_text")}}</b>
					</td>
				</tr>
				<tr>
					<td>是否显示</td>
					<td>
						<input type="radio" name="is_desc" value="1" {{$post->is_desc == 1 ? 'checked' : ''}}>是
						<input type="radio" name="is_desc" value="2" {{$post->is_desc == 2 ? 'checked' : ''}}>否
						<b style="color:red;">{{$errors->first("is_desc")}}</b>
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