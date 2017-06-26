<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
	<meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="renderer" content="webkit">
	<link href="/travelWeb/Public/css/bootstrap.min.css" type="text/css" rel="stylesheet" />
    <link href="/travelWeb/Public/css/holder.css" type="text/css" rel="stylesheet" />
	<link href="<?php echo (HOME_PUBLIC); ?>/css/common.css" type="text/css" rel="stylesheet" />
	<link href="<?php echo (HOME_PUBLIC); ?>/css/mycenter.css" type="text/css" rel="stylesheet" />
	<title>个人中心</title>
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
					<li><a href="/travelWeb/index.php/Home/Index/chat">社区交流</a></li>
                    <li class="active">
                        <?php if($_SESSION['username'] == true): ?><a href="/travelWeb/index.php/Home/Index/mycenter"><?php echo ($_SESSION['username']); ?></a>
                        <?php else: ?><a href="/travelWeb/index.php/Home/Index/login">注册/登录</a><?php endif; ?>
                    </li>
                    <?php if($_SESSION['username'] == true): ?><li><a href="/travelWeb/index.php/Home/Index/logout">退出登录</a></li><?php endif; ?>
				</ul>
			</div><!--/.nav-collapse -->
		</div>
	</nav>

	<div class="container margin-top-120">
		<div class="row">
			<div class="user-part col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
				<div class="maozi"></div>
				<div class="without-side">
					<div class="img">
						<div class="user-pic">
							<img width="140" height="140" src="/travelWeb/Public/userImgs/<?php echo ($user["img"]); ?>" alt="<?php echo ($_SESSION['username']); ?>" />
						</div>
						<div class="counts">	
							<a class="follows" href="/travelWeb/index.php/Home/Index/showFollow?type=follows&&userid=<?php echo ($user["user_id"]); ?>" target="_blank">
								<div class="num"><?php echo ($user["follow_num"]); ?></div>
								<div class="sub">关注</div>
							</a>
							<a class="followers" href="/travelWeb/index.php/Home/Index/showFollow?type=followers&&userid=<?php echo ($user["user_id"]); ?>" target="_blank">
								<div class="num"><?php echo ($user["follower_num"]); ?></div>
								<div class="sub">粉丝</div>
							</a>
						</div>
					</div><!--img end-->

					<div class="user-info">
						<h1>
							<?php echo ($user["username"]); ?>
							<small>
								<a href="##" id="edit">
									<span class="glyphicon glyphicon-edit"></span>
								</a>
							</small>
						</h1>
						<p>
							<span>邮箱：</span>
							<span><?php echo ($user["email"]); ?></span>
						</p>
					</div><!--user-info end-->
				</div><!--without-side end-->

				<div class="user-tabs">
					<ul class="nav navbar-nav">
						<li>
							<a href="##" id="a-post" class="user_tag">我的帖子</a>
						</li>
						<li>
							<a href="##" id="a-comment" class="user_tag">我的回复</a>
						</li>
						<li class="hidden">
							<a href="##" id="a-collect" class="user_tag">我的收藏</a>
						</li>
					</ul>
				</div><!--user-tabs end-->
			</div>
		</div><!--row end-->

		<div class="row">
			<div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1 margin-top-20">
                <div id="my-posts">
                	<div id="cont" class="hide-div">
						<?php if(is_array($result)): foreach($result as $key=>$v): ?><div class="post-preview hide-div margin-bottom-10">
								<h3 class="post-title">
									<a href="/travelWeb/index.php/Home/Index/post?id=<?php echo ($v["posts_id"]); ?>" target="_blank">
										<?php echo ($v["posts_title"]); ?>
									</a>
								</h3>
								<div class="post-content">
									<?php echo (mb_substr($v["posts_content"],0,100,'utf-8')); ?>...
								</div>
								<p class="post-meta">
									<span class="glyphicon glyphicon-user"><?php echo ($v["posts_author"]); ?></span>
									<span class="glyphicon glyphicon-time"><?php echo ($v["posts_time"]); ?></span>
									<span class="glyphicon glyphicon-comment">(<?php echo ($v["com_num"]); ?>)评论</span>
									<a href="##" class="del-post" name="<?php echo ($v["posts_id"]); ?>">
	                                    <span class="glyphicon glyphicon-trash"></span>
	                                    删除
	                                </a>
	                                <span class="hide"><?php echo ($v["com_num"]); ?></span>
								</p>
							</div><?php endforeach; endif; ?>
	                </div>
	                <div id="real-cont"">
	                    <p class="text-center">您还没发表帖子哦~</p>
	                </div>
	                <div id="holder" class="holder pull-right margin-bottom-50"></div>
                </div><!--my-posts-->

                <div id="my-coms" class="hide-div">
                	<div id="coms" class="hide-div">
	                    <?php if(is_array($comments)): foreach($comments as $key=>$v): ?><div class="post-preview margin-bottom-10 hide-div">
	                            <p class="post-content">
	                            	<?php echo ($v["com_content"]); ?>
	                            	<a href="##" class="del-com" name="<?php echo ($v["comments_id"]); ?>"><small>删除</small></a>
	                           	</p>
	                            <p class="post-meta">
	                            	from:
	                            	<a href="/travelWeb/index.php/Home/Index/post?id=<?php echo ($v["posts_id"]); ?>" target="_blank"><?php echo ($v["posts_title"]); ?></a>
	                            </p>
	                        </div><?php endforeach; endif; ?>
	                </div>
	                <div id="real-coms">
	                    <p class="text-center">您还没有评论，赶紧去评论吧！</p>
	                </div>
	                <div id="com-holder" class="holder pull-right margin-bottom-50"></div>
                </div><!--my-coms-->
			</div>

		<!--弹框-->
		<div class='edit-mask'></div>
		<div class='edit-cont'>
			<div class='edit-title'>
				<div class="row text-center">
                     <div class="col-xs-6">
                         <a href="#" class="active" id="edit-info">修改资料</a>
                     </div>
                     <div class="col-xs-6">
                         <a href="#" id="edit-pwd">修改密码</a>
                     </div>
                 </div>
			</div>
			<div class='edit-body'>
				<form class="form-horizontal" action="/travelWeb/index.php/Home/Index/upload" id="form-info" method="post" enctype="multipart/form-data">
					<div class="form-group">
						<label for="edit-name">用户名：</label>
						<input class="form-control" id="edit-name" type="text" name="username" value="<?php echo ($user["username"]); ?>" />
						<input type="hidden" name="userid" id="user-id" value="<?php echo ($user["user_id"]); ?>" />
					</div>
					<div class="form-group">
						<label for="edit-email">邮&nbsp;&nbsp;&nbsp;箱：</label>
						<input class="form-control" id="edit-email" type="email" name="email" value="<?php echo ($user["email"]); ?>" />
					</div>
					<div class="form-group">
						<label for="edit-file">头&nbsp;&nbsp;&nbsp;像：</label>
						<input id="edit-pic" type="file" name="pic">
					</div>
					<div class="form-group subs">
						<span id="son"></span>
						<input class="form-control btn btn-success" id="sm-info" type="submit" name="submit" value="提交" />
						<button class="form-control btn btn-success cancel" name="cancel">取消</button>
					</div>
				</form>

				<form class="form-horizontal" id="form-pwd" method="post">
					<div class="form-group">
						<label for="old-pwd">&nbsp;&nbsp;&nbsp;旧密码：</label>
						<input class="form-control" id="old-pwd" type="password" name="old-pwd" placeholder="请输入旧密码" autofocus />
					</div>
					<div class="form-group">
						<label for="new-pwd">&nbsp;&nbsp;&nbsp;新密码：</label>
						<input class="form-control" id="new-pwd" type="password" name="new-pwd" placeholder="请输入新密码" />
					</div>
					<div class="form-group">
						<label for="check-pwd">确认密码：</label>
						<input class="form-control" id="check-pwd" type="password" name="check-pwd" placeholder="请输入确认密码" />
					</div>
					<div class="form-group subs">
						<input class="form-control btn btn-success" id="sm-pwd" type="submit" name="submit" value="提交" />
						<button class="form-control btn btn-success cancel" name="cancel">取消</button>
					</div>
				</form>
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
    <script src="/travelWeb/Public/js/jquery.pagination.js"></script>
    <script src="<?php echo (HOME_PUBLIC); ?>/js/common.js"></script>
    <script src="<?php echo (HOME_PUBLIC); ?>/js/mycenter.js"></script>
</body>
</html>