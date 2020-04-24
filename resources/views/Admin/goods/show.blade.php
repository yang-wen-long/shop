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
		<h2>展示分类 <a href="{{url('/goods/')}}">分类添加</a></h2>
		<form>
	商品名称：<input type="text" name="goods_name" style="color:red" value="{{$goods_name}}">
商品价格区间：<input type="text" name="goods_price" value="{{$goods_price}}">— —
			  <input type="text" name="goods_prices" value="{{$goods_prices}}">
	商品品牌:<select name="blog_name" id="">
				<option value="">—请选择—</option>
				@foreach($all as $error)
				<option value="{{$error->blog_name}}" {{$blog_name == $error->blog_name ? "selected" : ""}}>{{$error->blog_name}}</option>
				@endforeach
			</select>
	是否新品:<input type="radio" name="is_nwe" value="1" {{$is_nwe == 1 ? "checked" : ""}}>是
			 <input type="radio" name="is_nwe" value="2" {{$is_nwe == 2 ? "checked" : ""}}>否
			<input type="submit" value="搜索">
		</form>
		<table>
			<thead>
				<th>分类ID</th>
				<th>商品名称</th>
				<th>商品价格</th>
				<th>商品详情</th>
				<th>商品库存</th>
				<th>商品货号</th>
				<th>商品主图</th>
				<th>商品相册</th>
				<th>是否显示</th>
				<th>是否新品</th>
				<th>是否精品</th>
				<th>是否是幻灯片推荐</th>
				<th>商品品牌</th>
				<th>商品分类</th>
				<th>操作</th>
			</thead>
		    <tbody>
				@foreach($goods as $error)
				<tr>
					<td>{{$error->goods_id}}</td>
					<td>{{$error->goods_name}}</td>
					<td>{{$error->goods_price}}</td>
					<td>{{$error->goods_desc}}</td>
					<td>{{$error->goods_num}}</td>
					<td>{{$error->goods_score}}</td>
					<td>
						<img src="http://uploads.1910.com/{{$error->goods_img}}" width="100px">
					</td>
					<td>
						@foreach($error["goods_imgs"] as $a)
						<img src="http://uploads.1910.com/{{$a}}" width="100px">
						@endforeach
					</td>
					<td>{{$error->is_show == 1 ? "是" : "否"}}</td>
					<td>{{$error->is_nwe == 1 ? "是" : "否"}}</td>
					<td>{{$error->is_hot == 1 ? "是" : "否"}}</td>
					<td>{{$error->is_slide == 1 ? "是" : "否"}}</td>
					<td>{{$error->blog_name}}</td>
					<td>{{$error->cate_name}}</td>
					<td>
						<a href="{{url('/goods/destroy/'.$error->goods_id)}}">删除</a>
						<a href="{{url('/goods/edit/'.$error->goods_id)}}">修改</a>
					</td>
				</tr>
				@endforeach
				<tr>
					<td colspan="14">
						{{$goods->appends($sql)->links()}}
					</td>
				</tr>
		 </tbody>
		</table>
	</center>
</body>
</html>
<script>
	$(document).ready(function(){
		$(document).on("click",".page-item a",function(){
			var url = $(this).attr("href");
			// $.get(url,function(index){
			// 	$("tbody").html(index);
			// });
			$.ajaxSetup({
				headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')} });
			$.post(url,function(index){
				$("tbody").html(index);
			});
			return false;
		});
	});
</script>