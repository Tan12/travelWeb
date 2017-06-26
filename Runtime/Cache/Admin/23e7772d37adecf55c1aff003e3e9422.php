<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
    <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="renderer" content="webkit">
    <link href="/travelWeb/Public/css/bootstrap.min.css" type="text/css" rel="stylesheet" />
	<link href="<?php echo (ADMIN_PUBLIC); ?>/css/common.css" type="text/css" rel="stylesheet" />
    <link href="<?php echo (ADMIN_PUBLIC); ?>/css/manageUsers.css" type="text/css" rel="stylesheet" />
    <title>管理用户</title>
</head>

<body>
    <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand">Travel Web</a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="/travelWeb/index.php/Admin/Index/index">管理新闻</a></li>
                    <li><a href="/travelWeb/index.php/Admin/Index/manageTips">管理攻略</a></li>
                    <li><a href="/travelWeb/index.php/Admin/Index/manageViews">管理景点</a></li>
                    <li><a href="/travelWeb/index.php/Admin/Index/managePosts">管理帖子</a></li>
                    <li class="active"><a href="/travelWeb/index.php/Admin/Index/manageUsers">管理用户</a></li>
                    <li><a href="/travelWeb/index.php/Admin/Index/logout">退出登录</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-10 col-sm-offset-1 col-md-10 col-md-offset-1">
                <div class="row">
                    <?php if(is_array($users)): foreach($users as $key=>$user): ?><div class="col-sm-2 col-md-2 text-center userDiv">
                            <a href="/travelWeb/index.php/Admin/Index/showuser?name=<?php echo ($user["username"]); ?>" target="_blank">
                                <img width="100" height="100" src="/travelWeb/Public/userImgs/<?php echo ($user["img"]); ?>" alt="<?php echo ($user["username"]); ?>" />
                                <h4 class="name"><?php echo ($user["username"]); ?></h4>
                            </a>
                            <a class="del" href="##" name="<?php echo ($user["user_id"]); ?>"><small>删除</small></a>
                        </div><?php endforeach; endif; ?>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
      function getURL(){
        return "/travelWeb/index.php/Admin/Index";
      }
    </script>
    <script src="/travelWeb/Public/js/jquery-2.2.2.min.js"></script>
	<script src="/travelWeb/Public/js/bootstrap.min.js"></script>
    <script src="<?php echo (ADMIN_PUBLIC); ?>/js/manageuers.js"></script>
</body>
</html>