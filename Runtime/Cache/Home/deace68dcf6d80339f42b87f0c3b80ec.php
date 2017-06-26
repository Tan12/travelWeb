<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="renderer" content="webkit">
    <link href="/travelWeb/Public/css/bootstrap.min.css" type="text/css" rel="stylesheet" />
    <link href="/travelWeb/Public/css/holder.css" type="text/css" rel="stylesheet" />
    <link href="<?php echo (HOME_PUBLIC); ?>/css/common.css" type="text/css" rel="stylesheet" />
    <link href="<?php echo (HOME_PUBLIC); ?>/css/post.css" type="text/css" rel="stylesheet" />
    <title>帖子详情</title>
</head>
<body>
    <div class="container">
        <div class="row show-post">
            <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                <h1 class="post-title"><?php echo ($posts["posts_title"]); ?></h1>
                <p class="post-meta">
                    作者：
                    <a href="/travelWeb/index.php/Home/Index/user?name=<?php echo ($posts["posts_author"]); ?>"><?php echo ($posts["posts_author"]); ?></a>
                </p>
                <p class="post-meta">时间：<?php echo ($posts["posts_time"]); ?></p>
                <p class="hidden" id="posts-id"><?php echo ($posts["posts_id"]); ?></p>
                <div class="post-content">
                    <?php echo ($posts["posts_content"]); ?>
                </div>
            </div>
        </div>
        <div class="row margin-top-20 com-part">
            <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                <p class="com-part-title">用户评论</p>
                <hr>
                <div id="cont" class="hide-div">
                    <?php if(is_array($comments)): foreach($comments as $key=>$v): ?><div class="post-preview margin-top-20 hide-div">
                            <p class="post-title">
                                <img src="/travelWeb/Public/userImgs/<?php echo ($v["img"]); ?>" />
                                <strong>&nbsp;<?php echo ($v["username"]); ?>&nbsp;</strong>
                                <?php echo ($v["comments_time"]); ?>
                            </p>
                            <p class="post-content"><?php echo ($v["com_content"]); ?></p>
                        </div><?php endforeach; endif; ?>
                </div>
                <div id="real-cont">
                    <p>还没有评论，赶紧去评论吧！</p>
                </div>
                <div id="holder" class="holder pull-right"></div>

                <form id="post-com" method="post" class="form-inline margin-top-50">
                    <hr>
                    <div class="form-group">
                        <label for="comment">输入你的评论：</label>
                        <input id="comment" class="form-control" type="text" name="comment" placeholder="请输入评论" />
                    </div>
                    <div class="form-group">
                        <input class="btn btn-success" type="submit" name="submit" value="提交" />
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script type="text/javascript">
      function getURL(){
        return "/travelWeb/index.php/Home/Index";
      }
      function getName(){
        return "<?php echo ($_SESSION['user_id']); ?>";
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
    <script src="<?php echo (HOME_PUBLIC); ?>/js/post.js"></script>
</body>
</html>