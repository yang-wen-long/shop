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
						<a href="{{url('/area/destroy/'.$error->area_id)}}">删除</a>
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