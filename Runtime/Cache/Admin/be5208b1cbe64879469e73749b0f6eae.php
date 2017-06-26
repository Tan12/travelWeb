<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="renderer" content="webkit">
    <link href="/travelWeb/Public/css/bootstrap.min.css" type="text/css" rel="stylesheet" />
    <link href="<?php echo (ADMIN_PUBLIC); ?>/css/common.css" type="text/css" rel="stylesheet" />
    <title>景点介绍</title>
    <style>
        body{
            padding: 0;
        }
        .container{
            margin-top: 30px;
            margin-bottom: 40px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                    <h1 class="post-title"><?php echo ($result["sights_name"]); ?></h1>
                    <p class="post-meta">城市：<?php echo ($result["city"]); ?></p>
                    <p class="post-meta">地址：<?php echo ($result["address"]); ?></p>
                    <p class="post-meta">门票：<?php echo ($result["ticket"]); ?></p>
                    <div class="post-content">
                        <?php echo ($result["intro"]); ?>
                    </div>
                </div>
        </div>
    </div>
</body>
</html>