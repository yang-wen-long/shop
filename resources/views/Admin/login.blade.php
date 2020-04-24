<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>后台登录页面</title>
</head>
<body>
	<center>
					<b>后台登录页面</b><br>
		<font color="red">{{session("get")}}</font>
		<form action="{{url('/Lofindo')}}" method="post">
			@csrf
			<table border="1">
				<tr>
					<td>账号</td>
					<td>
						<input type="text" name="admin_name" placeholder="管理员名称">
					</td>
				</tr>
				<tr>
					<td>密码</td>
					<td>
						<input type="password" name="admin_pwd" placeholder="密码">
					</td>
				</tr>
				<tr>
					<td>七天免登录</td>
					<td>
						<input type="checkbox" name="checked" value="yang">七天免登录
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