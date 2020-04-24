			<tr>
				<td>商品ID</td>
				<td>商品名称</td>
				<td>品牌网站</td>
				<td>商品LOGO</td>
				<td>商品描述</td>
				<td>操作</td>
			</tr>
			@foreach($user as $error)
			<tr>
				<td>{{$error->blog_id}}</td>
				<td>{{$error->blog_name}}</td>
				<td>{{$error->blog_url}}</td>
				<td>
					<img src="http://uploads.1910.com/{{$error->blog_logo}}" width="100px">
				</td>
				<td>{{$error->blog_desc}}</td>
				<td>
					<a href="{{url('/brand/destroy/'.$error->blog_id)}}">删除</a>||
					<a href="{{url('/brand/edit/'.$error->blog_id)}}">修改</a>
				</td>
			</tr>
			@endforeach