<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
	<meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="renderer" content="webkit">
	<link href="/travelWeb/Public/css/bootstrap.min.css" type="text/css" rel="stylesheet" />
	<link href="<?php echo (HOME_PUBLIC); ?>/css/common.css" type="text/css" rel="stylesheet" />
	<link href="<?php echo (HOME_PUBLIC); ?>/css/login.css" type="text/css" rel="stylesheet">
	<title>用户登录</title>
    <style>
        html{
			background: url("<?php echo (HOME_PUBLIC); ?>/images/login-back.jpg") no-repeat center center fixed;
			-webkit-background-size: cover;
			-moz-background-size: cover;
			-o-background-size: cover;
			background-size: cover;
		}
    </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3 panel panel-default text-center">
                <h2>爱旅游，爱生活。</h2>
                <div class="panel-head">
                     <div class="row">
                         <div class="col-xs-6">
                             <a href="#" class="active" id="login">登录</a>
                         </div>
                         <div class="col-xs-6">
                             <a href="#" id="register">注册</a>
                         </div>
                     </div>
                     <hr />
                </div>

                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                             <form id="login-form" class="form-horizontal" method="post">
                                <div class="form-group">
                                    <input class="form-control" id="name" type="text" name="name" placeholder="用户名" autofocus />
                                </div>
                                <div class="form-group">
                                     <input class="form-control" id="pwd" type="password" name="pwd" placeholder="密码" />
                                </div>
                                <div class="form-group">
                                    <input class="form-control" id="verify" class="input" type="text" name="verify" placeholder="验证码" />
                                </div>
                                <div class="form-group">
                                    <img id="verifyPic" src="/travelWeb/index.php/Home/Index/captcha"  onclick="this.src='/travelWeb/index.php/Home/Index/captcha/'+Math.random()" />
                                </div>
                                <div class="form-group text-align hide">
                                    <input type="checkbox" name="remember" id="remember" />
                                    <label for="remember">记住我</label>
                                </div>
                                <div class="form-group">
                                    <input class="btn btn-success" id="submit" type="submit" name="sm" value="登录" />
                                </div>
                            </form>

                            <form id="register-form" class="form-horizontal" method="post">
                                <div class="form-group">
                                    <input class="form-control" id="name2" type="text" name="name2" placeholder="用户名" autofocus />
                                </div>
                                <div class="form-group">
                                    <input class="form-control" id="email" type="email" name="email" placeholder="邮箱" />
                                </div>
                                <div class="form-group">
                                    <input class="form-control" id="pwd2" type="password" name="pwd2" placeholder="密码" />
                                </div>
                                <div class="form-group">
                                    <input class="form-control" id="pwd22" type="password" name="pwd22" placeholder="确认密码" />
                                </div>
                                <div class="form-group">
                                    <input class="form-control btn btn-success" type="submit" name="sm2" value="注册" />
                                </div>
                            </form>
                            <a href="/travelWeb/index.php/Home/Index/index">返回首页</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function getURL(){
    		return "/travelWeb/index.php/Home/Index";
    	}
    </script>
	<script src="/travelWeb/Public/js/jquery-2.2.2.min.js"></script>
	<script src="/travelWeb/Public/js/bootstrap.min.js"></script>
    <script src="<?php echo (HOME_PUBLIC); ?>/js/login.js"></script>
</body>
</html>