<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
	<meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="renderer" content="webkit">
	<link href="/travelWeb/Public/css/bootstrap.min.css" type="text/css" rel="stylesheet" />
    <link href="/travelWeb/Public/css/holder.css" type="text/css" rel="stylesheet" />
	<link href="<?php echo (ADMIN_PUBLIC); ?>/css/common.css" type="text/css" rel="stylesheet" />
	<link href="<?php echo (ADMIN_PUBLIC); ?>/css/user.css" type="text/css" rel="stylesheet" />
	<title>个人中心</title>
</head>

<body>
	<div class="container margin-top-50">
		<div class="row">
			<div class="user-part col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
				<div class="maozi"></div>
				<div class="without-side">
					<div class="img">
						<div class="user-pic">
							<img width="140" height="140" src="/travelWeb/Public/userImgs/<?php echo ($user["img"]); ?>" alt="<?php echo ($user["username"]); ?>" />
						</div>
						<div class="counts">	
							<a class="follows" href="/travelWeb/index.php/Admin/Index/showFollow?type=follows&&userid=<?php echo ($user["user_id"]); ?>" target="_blank">
								<div class="num"><?php echo ($user["follow_num"]); ?></div>
								<div class="sub">关注</div>
							</a>
							<a class="followers" href="/travelWeb/index.php/Admin/Index/showFollow?type=followers&&userid=<?php echo ($user["user_id"]); ?>" target="_blank">
								<div class="num"><?php echo ($user["follower_num"]); ?></div>
								<div class="sub">粉丝</div>
							</a>
						</div>
					</div><!--img end-->

					<div class="user-info">
						<h1><span><?php echo ($user["username"]); ?></span></h1>
						<p>
							<span>邮箱：</span>
							<span><?php echo ($user["email"]); ?></span>
						</p>
					</div><!--user-info end-->
				</div><!--without-side end-->

				<div class="user-tabs">
					<ul class="nav navbar-nav">
						<li>
							<a href="##" id="a-post" class="user_tag">Ta的帖子</a>
						</li>
						<li>
							<a href="##" id="a-comment" class="user_tag">Ta的回复</a>
						</li>
						<li class="hidden">
							<a href="##" id="a-collect" class="user_tag">Ta的收藏</a>
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
									<a href="/travelWeb/index.php/Admin/Index/post?id=<?php echo ($v["posts_id"]); ?>" target="_blank">
										<?php echo ($v["posts_title"]); ?>
									</a>
								</h3>
								<div class="post-content">
									<?php echo (mb_substr($v["posts_content"],0,100,'utf-8')); ?>...
								</div>
								<p class="post-meta">
									<span class="glyphicon glyphicon-user"><?php echo ($v["posts_author"]); ?></span>
									<span class="glyphicon glyphicon-time"><?php echo ($v["posts_time"]); ?></span>
									<span class="glyphicon glyphicon-comment">(<?php echo ($v["coms_num"]); ?>)评论</span>
									<a href="##" class="del-post" name="<?php echo ($v["posts_id"]); ?>">
	                                    <span class="glyphicon glyphicon-trash"></span>
	                                    删除
	                                </a>
	                                <span class="hide"><?php echo ($v["com_num"]); ?></span>
								</p>
							</div><?php endforeach; endif; ?>
	                </div>
	                <div id="real-cont">
	                    <p class="text-center">Ta还没发表帖子哦~</p>
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
	                            	<a href="/travelWeb/index.php/Admin/Index/post?id=<?php echo ($v["posts_id"]); ?>" target="_blank"><?php echo ($v["posts_title"]); ?></a>
	                            </p>
	                        </div><?php endforeach; endif; ?>
	                </div>
	                <div id="real-coms">
	                    <p class="text-center">Ta还没发表评论哦~</p>
	                </div>
	                <div id="com-holder" class="holder pull-right margin-bottom-50"></div>
                </div><!--my-com-->
			</div>
		</div>
	</div>


	<script>
        function getURL(){
    		return "/travelWeb/index.php/Admin/Index";
    	}
    	function getUser(){
    		return "<?php echo ($user["user_id"]); ?>";
    	}
    </script>
	<script src="/travelWeb/Public/js/jquery-2.2.2.min.js"></script>
	<script src="/travelWeb/Public/js/bootstrap.min.js"></script>
    <script src="/travelWeb/Public/js/jquery.pagination.js"></script>
    <script src="<?php echo (ADMIN_PUBLIC); ?>/js/common.js"></script>
    <script src="<?php echo (ADMIN_PUBLIC); ?>/js/user.js"></script>
</body>
</html>