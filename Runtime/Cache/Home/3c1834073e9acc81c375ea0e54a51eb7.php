<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
	<meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="renderer" content="webkit">
	<link href="/travelWeb/Public/css/bootstrap.min.css" type="text/css" rel="stylesheet" />
    <link href="/travelWeb/Public/css/holder.css" type="text/css" rel="stylesheet" />
	<link href="<?php echo (HOME_PUBLIC); ?>/css/common.css" type="text/css" rel="stylesheet" />
	<link href="<?php echo (HOME_PUBLIC); ?>/css/chat.css" type="text/css" rel="stylesheet" />
	<title>社区交流</title>
</head>

<body>
	<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand">Travel Web</a>
			</div>
			<div class="collapse navbar-collapse" id="navbar">
				<ul class="nav navbar-nav">
					<li><a href="/travelWeb/index.php/Home/Index/index">首页</a></li>
					<li><a href="/travelWeb/index.php/Home/Index/tips">旅游攻略</a></li>
					<li><a href="/travelWeb/index.php/Home/Index/views">景点介绍</a></li>
					<li class="active"><a href="/travelWeb/index.php/Home/Index/chat">社区交流</a></li>
                    <li>
                        <?php if($_SESSION['username'] == true): ?><a id="user-name" href="/travelWeb/index.php/Home/Index/mycenter"><?php echo ($_SESSION['username']); ?></a>
                        <?php else: ?><a href="/travelWeb/index.php/Home/Index/login">注册/登录</a><?php endif; ?>
                    </li>
                    <?php if($_SESSION['username'] == true): ?><li><a href="/travelWeb/index.php/Home/Index/logout">退出登录</a></li><?php endif; ?>
				</ul>
			</div><!--/.nav-collapse -->
		</div>
	</nav>

	<div class="container margin-top-50">
		<div class="row show-part margin-top-20">
			<div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1 sort-part">
				<div class="row">
					<div class="col-lg-4 col-md-5">
						<button class="btn btn-success" id="post">
							<span class="glyphicon glyphicon-edit"></span>
							发布帖子
						</button>
					</div>
					<div class="col-lg-4 col-lg-offset-4 col-md-5 col-md-offset-5">
						<form id="search" method="post">
							<input type="text" class="form-control" name="search" placeholder="请输入关键字...">
						</form>
					</div>
				</div>
				<hr>
			</div>
		</div>
		<div class="row show-part">
			<div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1" id="showTips">
				<div id="cont" class="hide-div">
					<?php if(is_array($result)): foreach($result as $key=>$v): ?><div class="post-preview hide-div">
							<h2 class="post-title">
								<a href="/travelWeb/index.php/Home/Index/post?id=<?php echo ($v["posts_id"]); ?>" target="_blank">
									<?php echo ($v["posts_title"]); ?>
								</a>
							</h2>
							<div class="post-content">
								<?php echo (mb_substr($v["posts_content"],0,100,'utf-8')); ?>...
							</div>
							<p class="post-meta">
								<span class="glyphicon glyphicon-user"><?php echo ($v["posts_author"]); ?></span>
								<span class="glyphicon glyphicon-time"><?php echo ($v["posts_time"]); ?></span>
								<span class="glyphicon glyphicon-comment">(<?php echo ($v["coms_num"]); ?>)评论</span>
							</p>
							<hr>
						</div><?php endforeach; endif; ?>
				</div>
				<div id="real-cont"></div>
                <div id="holder" class="holder pull-right"></div>
			</div>
		</div>
		<div class="row hide-part margin-top-20">
			<div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                <form id="add-post"  class="form-horizontal" method="post">
                    <div class="form-group">
                        <label>标题：</label>
                        <input class="form-control" type="text" id="post-title" name="post-title" placeholder="请输入标题" />
                    </div>
                    <div class="form-group">
                        <label>内容：</label>
                        <script id="editor" name="content" type="text/plain">
                            <p>请输入内容...</p>
                        </script>
                    </div>
                    <div class="form-group text-center">
                      <input class="btn btn-success" id="submit" type="submit" name="sm" value="提交" />
                      <input class="btn btn-success" id="cancel" type="button" name="cc" value="取消" />
                    </div>
                </form>
			</div>
		</div>
	</div>


	<script type="text/javascript">
      function getURL(){
        return "/travelWeb/index.php/Home/Index";
      }
    </script>
	<script src="/travelWeb/Public/js/jquery-2.2.2.min.js"></script>
	<script src="/travelWeb/Public/js/bootstrap.min.js"></script>
    <script src="/travelWeb/Public/js/jquery.pagination.js"></script>
    <!-- 配置文件 -->
    <script type="text/javascript" src="/travelWeb/Public/ueditor/ueditor.config.js"></script>
    <!-- 编辑器源码文件 -->
    <script type="text/javascript" src="/travelWeb/Public/ueditor/ueditor.all.js"></script>
    <script src="/travelWeb/Public/js/common.js"></script>
    <script src="<?php echo (HOME_PUBLIC); ?>/js/common.js"></script>
    <script src="<?php echo (HOME_PUBLIC); ?>/js/chat.js"></script>
</body>
</html>