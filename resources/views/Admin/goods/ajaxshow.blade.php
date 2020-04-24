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