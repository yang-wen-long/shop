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
		<h2>添加管理 <a href="{{url('/goods/index')}}">管理展示</a></h2>

		<form action="{{url('/goods/store')}}"  method="post" enctype="multipart/form-data">
			@csrf
			<table border="1">
				<tr>
					<td>商品名称</td>
					<td>
						<input type="text" name="goods_name" value="">
						<b style="color:red;">{{$errors->first("goods_name")}}</b>
					</td>
				</tr>
				<tr>
					<td>商品价格</td>
					<td>
						<input type="text" name="goods_price" value="">
						<b style="color:red;">{{$errors->first("goods_price")}}</b>
					</td>
				</tr>
				<tr>
					<td>商品详情</td>
					<td>
						<textarea name="goods_desc" id="" cols="30" rows="10"></textarea>
						<b style="color:red;">{{$errors->first("goods_desc")}}</b>
					</td>
				</tr>
				<tr>
					<td>商品库存</td>
					<td>
						<input type="text" name="goods_num" value="">
						<b style="color:red;">{{$errors->first("goods_num")}}</b>
					</td>
				</tr>
				<tr>
					<td>商品货号</td>
					<td>
						<input type="text" name="goods_score" value="">
						<b style="color:red;">{{$errors->first("goods_score")}}</b>
					</td>
				</tr>
				<tr>
					<td>商品主图</td>
					<td>
						<input type="file" name="goods_img">
					</td>
				</tr>
				<tr>
					<td>商品相册</td>
					<td>
						<input type="file" name="goods_imgs[]" multiple="multiple">
					</td>
				</tr>
				<tr>
					<td>是否显示</td>
					<td>
						<input type="radio" name="is_show" value="1" checked>是
						<input type="radio" name="is_show" value="2">否
						<b style="color:red;">{{$errors->first("is_show")}}</b>
					</td>
				</tr>
				<tr>
					<td>是否新品</td>
					<td>
						<input type="radio" name="is_nwe" value="1" checked>是
						<input type="radio" name="is_nwe" value="2">否
						<b style="color:red;">{{$errors->first("is_nwe")}}</b>
					</td>
				</tr>
				<tr>
					<td>是否精品</td>
					<td>
						<input type="radio" name="is_hot" value="1" checked>是
						<input type="radio" name="is_hot" value="2">否
						<b style="color:red;">{{$errors->first("is_hot")}}</b>
					</td>
				</tr>
				<tr>
					<td>是否是幻灯片推荐</td>
					<td>
						<input type="radio" name="is_slide" value="1" checked>是
						<input type="radio" name="is_slide" value="2">否
						<b style="color:red;">{{$errors->first("is_slide")}}</b>
					</td>
				</tr>
				<tr>
					<td>商品品牌</td>
					<td>
						<select name="blog_id" id="">
							<option value="">—请选择—</option>
							@foreach($all as $error)
							<option value="{{$error->blog_id}}">{{$error->blog_name}}</option>
							@endforeach
						</select>
						<b style="color:red;">{{$errors->first("blog_id")}}</b>
					</td>
				</tr>
				<tr>
					<td>商品分类</td>
					<td>
						<select name="cate_id" id="">
							<option value="">—请选择—</option>
							@foreach($arr as $error)
							<option value="{{$error->cate_id}}">{{str_repeat("+",$error["level"]*2)}}{{$error->cate_name}}</option>
							@endforeach
						</select>
						<b style="color:red;">{{$errors->first("cate_id")}}</b>
					</td>
				</tr>
				<tr>
					<td>操作</td>
					<td>
						<input type="submit" value="添加">
					</td>
				</tr>
			</table>
		</form>
	</center>
</body>
</html>