<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<link href="<?php echo (ADMIN_PUBLIC); ?>/css/login.css" type="text/css" rel="stylesheet">
	<title>管理员登录</title>
</head>

<body>
	<div class="login">
		<h2>管理员登陆</h2>
		<form method="post" action="/travelWeb/index.php/Admin/Login/index">
			<label>用户名：</label><input type="text" name="name" autofocus /><br /><br />
			<label>密&nbsp;&nbsp;&nbsp;码：</label><input type="password" name="pwd" /><br /><br />
			<label>验证码：</label><input class="input" type="text" name="verify" /><br /><br />
			<img src="/travelWeb/index.php/Admin/Login/getVerify"  onclick="this.src='/travelWeb/index.php/Admin/Login/getVerify/'+Math.random()" /><br /><br />
			<input type="submit" name="sm" value="登陆" />
		</form>
	</div>
	<script src="/travelWeb/Public/js/jquery-2.2.2.min.js"></script>
</body>
</html>