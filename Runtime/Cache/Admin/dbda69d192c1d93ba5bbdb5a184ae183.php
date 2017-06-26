<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
    <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="renderer" content="webkit">
    <link href="/travelWeb/Public/css/bootstrap.min.css" type="text/css" rel="stylesheet" />
    <link href="/travelWeb/Public/css/holder.css" type="text/css" rel="stylesheet" />
	<link href="<?php echo (ADMIN_PUBLIC); ?>/css/common.css" type="text/css" rel="stylesheet" />
    <link href="<?php echo (ADMIN_PUBLIC); ?>/css/managetips.css" type="text/css" rel="stylesheet" />
    <title>管理景点</title>
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
                    <li class="active"><a href="/travelWeb/index.php/Admin/Index/manageViews">管理景点</a></li>
                    <li><a href="/travelWeb/index.php/Admin/Index/managePosts">管理帖子</a></li>
                    <li><a href="/travelWeb/index.php/Admin/Index/manageUsers">管理用户</a></li>
                    <li><a href="/travelWeb/index.php/Admin/Index/logout">退出登录</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-3 col-md-2 sidebar">
                <ul class="nav nav-sidebar">
                    <li>
                        <form class="navbar-form" id="search" method="post">
                            <input type="text" class="form-control" name="search" placeholder="请输入关键字...">
                        </form>
                    </li>
                    <li id="show" class="active"><a href="#">已发布内容</a></li>
                    <li id="add"><a href="#">发布新内容</a></li>
                </ul>
            </div>
            <div class="col-sm-10 col-sm-offset-1 col-md-10 col-md-offset-2 main">
                <div class="col-lg-9 col-md-10 col-md-offset-1">
                    <div id="showTips">
                        <div id="tips">
                            <?php if(is_array($result)): foreach($result as $key=>$v): ?><div class="post-preview">
                                    <h2 class="post-title">
                                        <a href="/travelWeb/index.php/Admin/Index/view?id=<?php echo ($v["sights_id"]); ?>" target="_blank">   
                                            <?php echo ($v["sights_name"]); ?>
                                        </a>
                                    </h2>
                                    <div class="post-content">
                                        <?php echo (mb_substr($v["intro"],0,100,'utf-8')); ?>...
                                    </div>
                                    <p class="post-meta">
                                        <a class="del" href="##" name="<?php echo ($v["sights_id"]); ?>">删除</a>
                                        <a class="edit" href="##" name="<?php echo ($v["sights_id"]); ?>">编辑</a>
                                    </p>
                                    <hr>
                                </div><?php endforeach; endif; ?>
                        </div>
                        <div id="realTips"></div>
                        <div id="holder" class="holder pull-right"></div>
                    </div><!--showTips end-->

                    <form id="addTips"  class="form-horizontal" method="post">
                        <div class="form-group">
                            <label>名称：</label>
                            <input class="form-control" type="text" id="view-name" name="view-name" placeholder="请输入景点名称" />
                        </div>
                        <div class="form-group">
                            <label>城市：</label>
                            <input class="form-control" type="text" id="city" name="city" placeholder="请输入景点所属城市" />
                        </div>
                        <div class="form-group">
                            <label>地址：</label>
                            <input class="form-control" type="text" id="addr" name="addr" placeholder="请输入景点地址" />
                        </div>
                        <div class="form-group">
                            <label>门票：</label>
                            <input class="form-control" type="text" id="ticket" name="ticket" placeholder="请输入景点门票价格" />
                        </div>
                        <div class="form-group">
                            <label>介绍：</label>
                            <script id="editor" name="content" type="text/plain">
                                <p>请输入内容...</p>
                            </script>
                        </div>
                        <div class="form-group">
                          <input class="btn btn-primary" id="submit" type="submit" name="sm" value="提交" />
                          <input type="hidden" id="view-id" value="" />
                        </div>
                    </form>
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
    <script src="/travelWeb/Public/js/jquery.pagination.js"></script>
    <!-- 配置文件 -->
    <script type="text/javascript" src="/travelWeb/Public/ueditor/ueditor.config.js"></script>
    <!-- 编辑器源码文件 -->
    <script type="text/javascript" src="/travelWeb/Public/ueditor/ueditor.all.js"></script>
    <script src="/travelWeb/Public/js/common.js"></script>
    <script src="<?php echo (ADMIN_PUBLIC); ?>/js/common.js"></script>
    <script src="<?php echo (ADMIN_PUBLIC); ?>/js/manageviews.js"></script>
</body>
</html>