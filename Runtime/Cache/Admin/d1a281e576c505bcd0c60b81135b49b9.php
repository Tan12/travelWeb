<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
	<meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="renderer" content="webkit">
	<link href="/travelWeb/Public/css/bootstrap.min.css" type="text/css" rel="stylesheet" />
    <link href="/travelWeb/Public/css/holder.css" type="text/css" rel="stylesheet" />
	<link href="<?php echo (HOME_PUBLIC); ?>/css/common.css" type="text/css" rel="stylesheet" />
	<title>关注&粉丝</title>
</head>

<body>
	<div class="container margin-top-20">
		<div class="row">
			<div class="col-sm-10 col-sm-offset-1 col-md-10 col-md-offset-1">
				<h1 class="text-center"></h1>
				<hr>
				<div id="showUser" class="hide-div">
                    <?php if(is_array($users)): foreach($users as $key=>$user): ?><div class="col-sm-2 col-md-2 text-center">
	                        <a href="/travelWeb/index.php/Admin/Index/showuser?name=<?php echo ($user["username"]); ?>" target="_blank">
	                            <img width="100" height="100" src="/travelWeb/Public/userImgs/<?php echo ($user["img"]); ?>" alt="<?php echo ($user["username"]); ?>" />
	                            <h4 class="name"><?php echo ($user["username"]); ?></h4>
	                            <p class="email"><?php echo ($user["email"]); ?></p>
	                        </a>
	                    </div><?php endforeach; endif; ?>
                </div>
                <p class="text-center hide-div">没有相关用户~</p>
            </div>
		</div>
	</div>

	<script>
        function getURL(){
    		return "/travelWeb/index.php/Admin/Index";
    	}
    	function getID(){
    		return "<?php echo ($user["user_id"]); ?>";
    	}
    </script>
	<script src="/travelWeb/Public/js/jquery-2.2.2.min.js"></script>
	<script src="/travelWeb/Public/js/bootstrap.min.js"></script>
    <script src="/travelWeb/Public/js/jquery.pagination.js"></script>
    <script src="<?php echo (ADMIN_PUBLIC); ?>/js/common.js"></script>
    <script src="<?php echo (HOME_PUBLIC); ?>/js/follow.js"></script>
</body>
</html>