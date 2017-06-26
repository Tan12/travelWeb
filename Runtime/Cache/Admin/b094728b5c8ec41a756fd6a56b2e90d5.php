<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
    <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="renderer" content="webkit">
    <link href="/travelWeb/Public/css/bootstrap.min.css" type="text/css" rel="stylesheet" />
    <link href="/travelWeb/Public/css/holder.css" type="text/css" rel="stylesheet" />
	<link href="<?php echo (ADMIN_PUBLIC); ?>/css/common.css" type="text/css" rel="stylesheet" />
    <link href="<?php echo (ADMIN_PUBLIC); ?>/css/index.css" type="text/css" rel="stylesheet" />
    <title>管理帖子</title>
    <style>
        #search{
            padding: 0;
        }
        #search .form-control{
            width: 250px;
        }
    </style>
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
                    <li><a href="/travelWeb/index.php/Admin/Index/managetips">管理攻略</a></li>
                    <li><a href="/travelWeb/index.php/Admin/Index/manageViews">管理景点</a></li>
                    <li class="active"><a href="/travelWeb/index.php/Admin/Index/managePosts">管理帖子</a></li>
                    <li><a href="/travelWeb/index.php/Admin/Index/manageUsers">管理用户</a></li>
                    <li><a href="/travelWeb/index.php/Admin/Index/logout">退出登录</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 col-md-8 col-md-offset-2">
                <form class="navbar-form pull-right" id="search" method="post">
                    <label for="search">搜索帖子：</label>
                    <input type="text" class="form-control" name="search" placeholder="请输入关键字...">
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 col-md-8 col-md-offset-2" id="showTips">
                <div id="cont" class="hide-div">
                    <?php if(is_array($result)): foreach($result as $key=>$v): ?><div class="post-preview hide-div">
                            <h2 class="post-title">
                                <a href="/travelWeb/index.php/Admin/Index/post?id=<?php echo ($v["posts_id"]); ?>" target="_blank">
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
                                <a href="##" class="del" name="<?php echo ($v["posts_id"]); ?>">
                                    <span class="glyphicon glyphicon-trash"></span>
                                    删除
                                </a>
                                <span class="hide"><?php echo ($v["coms_num"]); ?></span>
                            </p>
                            <hr>
                        </div><?php endforeach; endif; ?>
                </div>
                <div id="real-cont"></div>
                <div id="holder" class="holder pull-right"></div>
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
    <script src="/travelWeb/Public/js/jquery.pagination.js"></script>
    <!-- 配置文件 -->
    <script type="text/javascript" src="/travelWeb/Public/ueditor/ueditor.config.js"></script>
    <!-- 编辑器源码文件 -->
    <script type="text/javascript" src="/travelWeb/Public/ueditor/ueditor.all.js"></script>
    <script src="/travelWeb/Public/js/common.js"></script>
    <script src="<?php echo (ADMIN_PUBLIC); ?>/js/common.js"></script>
    <script src="<?php echo (ADMIN_PUBLIC); ?>/js/manageposts.js"></script>
</body>
</html>