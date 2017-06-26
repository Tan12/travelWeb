<?php
namespace Admin\Controller;
header("Content-type:text/html;charset=utf8");
use Think\Controller;
class IndexController extends CommonController {
  //后台首页-管理新闻
  public function index(){
    $model = D('news');
      $result = $model->order('news_time desc')->select();
      $count = count($result);
      for($i = 0; $i < $count; $i++){
        // 去除内容中的html标签
        $result[$i]['news_content'] = strip_tags($result[$i]['news_content']);
      }
      $this->assign('result', $result);
      $this->display();
  }
  public function searchNews(){    
    $keyword = I('post.keyword','','');
    $where['news_title']=array('like', '%'.$keyword.'%');
    $model = D('news'); 
    $result = $model->where($where)->order('news_time desc')->select();
    $count = count($result);
    for($i = 0; $i < $count; $i++){
      // 去除内容中的html标签
      $result[$i]['news_content'] = strip_tags($result[$i]['news_content']);
      $result[$i]['news_content'] = mb_substr($result[$i]['news_content'], 0, 100, 'utf-8');
    }
    $this->ajaxReturn($result);
  }
  public function addNew(){
    $data['news_title'] = I('post.title','','');
    $data['news_content'] = I('post.content','','');
    $data['news_time'] = date("Y-m-d H:i:s");
    $model = M('news');
    $result = $model->data($data)->add();
    $msg = $result ? "添加成功！" : "添加失败，请重试！";
    $this->ajaxReturn($msg);
  }
  public function delNew(){
    $where['news_id'] = I('post.id','','');
    $model = M('news');
    $result = $model->where($where)->delete();
    if($result){
      $this->ajaxReturn('删除成功！');
    }else{
      $this->ajaxReturn('删除失败，请重试！');
    }
  }

  // 管理攻略页面begin
  // 显示管理攻略页面
	public function manageTips(){
		  $model = D('tips');
    	$result = $model->order('tips_time desc')->select();
      $count = count($result);
      for($i = 0; $i < $count; $i++){
        // 去除内容中的html标签
        $result[$i]['tips_content'] = strip_tags($result[$i]['tips_content']);
      }
    	$this->assign('result', $result);
    	$this->display();
	}

  // 筛选攻略
  public function searchTips(){    
    $keyword = I('post.keyword','','');
    $where['tips_title']=array('like', '%'.$keyword.'%');
    $model = D('tips'); 
    $result = $model->where($where)->order('tips_time desc')->select();
    $count = count($result);
    for($i = 0; $i < $count; $i++){
      // 去除内容中的html标签
      $result[$i]['tips_content'] = strip_tags($result[$i]['tips_content']);
      $result[$i]['tips_content'] = mb_substr($result[$i]['tips_content'], 0, 100, 'utf-8');
    }
    $this->ajaxReturn($result);
  }

  // 删除攻略
  public function delTip(){
    $where['tips_id'] = I('post.id','','');
    $model = M('tips');
    $result = $model->where($where)->delete();
    if($result){
      $this->ajaxReturn('删除成功！');
    }else{
      $this->ajaxReturn('删除失败，请重试！');
    }
  }

  // 添加攻略
  public function addTip(){
    $data['tips_title'] = I('post.title','','');
    $data['tags'] = I('post.tags','','');
    $data['tips_content'] = I('post.content','','');
    $data['tips_author'] = session('name');
    $data['tips_time'] = date("Y-m-d H:i:s");
    $model = M('tips');
    $result = $model->data($data)->add();
    $msg = $result ? "添加成功！" : "添加失败，请重试！";
    $this->ajaxReturn($msg);
  }

  // 攻略详情页面
  public function message(){
     if($_GET['id']){
        $id = $_GET['id'];
        $model = D('tips');
        $where['tips_id']=$id;
        $result = $model->where($where)->find();
        $this->assign('result', $result);
        $this->display('message');
     }else{
        $this->display('404');
     }
  }
  // 管理攻略页面end

  // 管理景点页面begin
  public function manageViews(){
    $model = D('sights');
    $result = $model->order('sights_id desc')->select();
    $count = count($result);
    for($i = 0; $i < $count; $i++){
      // 去除内容中的html标签
      $result[$i]['intro'] = strip_tags($result[$i]['intro']);
    }
    $this->assign('result', $result);
    $this->display();
  }
  // 返回景点信息
  public function returnView(){
    $id = I('post.id','','');
    $model = D('sights');
    $where['sights_id']=$id;
    $result = $model->where($where)->find();
    $this->ajaxReturn($result);
  }
  // 添加景点介绍
  public function addView(){
    $data['sights_name'] = I('post.name','','');
    $data['city'] = I('post.city','','');
    $data['address'] = I('post.addr','','');
    $data['ticket'] = I('post.ticket','','');
    $data['intro'] = I('post.content','','');
    $sm  = I('post.sm','','');
    $model = M('sights');
    if($sm === '提交'){
      $result = $model->data($data)->add();
    }else if($sm === '修改'){
      $data['sights_id'] = I('post.id','','');
      $result = $model->save($data);
    }
    $msg = $result ? "添加成功！" : "添加失败，请重试！";
    $this->ajaxReturn($msg);
  }
  // 筛选景点
  public function searchViews(){    
    $keyword = I('post.keyword','','');
    $where['sights_name']=array('like', '%'.$keyword.'%');
    $model = D('sights'); 
    $result = $model->where($where)->order('sights_id desc')->select();
    $count = count($result);
    for($i = 0; $i < $count; $i++){
      // 去除内容中的html标签
      $result[$i]['intro'] = strip_tags($result[$i]['intro']);
      $result[$i]['intro'] = mb_substr($result[$i]['intro'], 0, 100, 'utf-8');
    }
    $this->ajaxReturn($result);
  }
  // 删除景点
  public function delView(){
    $where['sights_id'] = I('post.id','','');
    $model = M('sights');
    $result = $model->where($where)->delete();
    if($result){
      $this->ajaxReturn('删除成功！');
    }else{
      $this->ajaxReturn('删除失败，请重试！');
    }
  }
  // 景点介绍
  public function view(){
     if($_GET['id']){
        $id = $_GET['id'];
        $model = D('sights');
        $where['sights_id']=$id;
        $result = $model->where($where)->find();
        $this->assign('result', $result);
        $this->display('view');
     }else{
        $this->display('404');
     }
  }
  // 管理景点页面end

  // 管理帖子页面begin
  public function managePosts(){
    $model = D('posts');
    $result = $model->order('posts_time desc')->select();
    $count = count($result);
    $coms = D('comments');
    for($i = 0; $i < $count; $i++){
     // 去除内容中的html标签
       $result[$i]['posts_content'] = strip_tags($result[$i]['posts_content']);
       $where['posts_id'] = $result[$i]['posts_id'];
       $num = $coms->where($where)->order('comments_time desc')->select();
       $result[$i]['coms_num'] = count($num);
    }
    //var_dump($result);
    $this->assign('result', $result);
    $this->display();
  }
  public function searchPost(){
    $keyword = I('post.keyword','','');
    $where['posts_title']=array('like', '%'.$keyword.'%');
    $model = D('posts');
    $result = $model->where($where)->order('posts_time desc')->select();
      $count = count($result);

      $coms = D('comments');
        for($i = 0; $i < $count; $i++){
         // 去除内容中的html标签
           $result[$i]['posts_content'] = strip_tags($result[$i]['posts_content']);
           $where['posts_id'] = $result[$i]['posts_id'];
           $num = $coms->where($where)->order('comments_time desc')->select();
           $result[$i]['coms_num'] = count($num);
        }
        $this->ajaxReturn($result);
  }
  public function delPost(){
    $where['posts_id'] = I('post.id','','');
    $num = I('post.num','','');
    $model = D('posts');
    $coms = D('comments');
    $result_2 = 1;
    if($num > 0){
      $result_2 = $coms->where($where)->delete();
    }
    $result = $model->where($where)->delete();
    if($result && $result_2){
      $this->ajaxReturn('删除成功！');
    }else{
      $this->ajaxReturn('删除失败，请重试！');
    }
  }
  public function post(){
    if($_GET['id']){
      $id = $_GET['id'];
      $posts = D('posts');
      $where['posts_id']=$id;
      $result1 = $posts->where($where)->find();

      $comments = D('comments');
        $result2 = $comments->where($where)->order('comments_time desc')->select();
        $count = count($result2);
        $users = M('users');
        for($i = 0;$i < $count; $i++){
          $where['user_id'] = $result2[$i]['user_id'];
          $re = $users->where($where)->find();
          $result2[$i]['username'] = $re['username'];
          $result2[$i]['img'] = $re['img'];
        }
        //var_dump($result2);
      $this->assign('posts', $result1);
      $this->assign('comments', $result2);
      $this->display('post');
    }else{
      $this->display('404');
    }
  }
  // 删除评论
  public function delCom(){
    $where['comments_id'] = I('post.id','','');
    $coms = D('comments');
    $result = $coms->where($where)->delete();
    if($result){
      $this->ajaxReturn('删除成功！');
    }else{
      $this->ajaxReturn('删除失败，请重试！');
    }
  }
  // 管理帖子页面end

  // 管理用户页面begin
  public function manageUsers(){
    $model = D('users');
    $users = $model->order('user_id desc')->select();
    $this->assign('users', $users);
    $this->display();
  }
  // 用户详情页面
  public function user(){
     if($_GET['name']){
        $name = $_GET['name'];
        $model = D('users');
        $where['username']=$name;
        $result = $model->where($where)->order('user_id desc')->find();
        $this->assign('user', $result);
        $this->display('user');
     }else{
        $this->display('404');
     }
  }
  // 删除用户
  public function delUser(){
    $where['user_id'] = I('post.id','','');
    $model = M('users');
    $result = $model->where($where)->delete();
    if($result){
      $this->ajaxReturn('删除成功！');
    }else{
      $this->ajaxReturn('删除失败，请重试！');
    }
  }
  // 用户中心
  public function showuser(){
    if($_GET['name']){
        $name = $_GET['name'];
        $model = D('users');
        $where['username']=$name;
        $user = $model->where($where)->find();
        $follows = $user['follows'] ? explode(",", $user['follows']) : [];
        $followers = $user['followers'] ? explode(",", $user['followers']) : [];
        $user['follow_num'] = count($follows);
        $user['follower_num'] = count($followers);

        $posts = D('posts');
        $where2['posts_author'] = $name;
        $result = $posts->where($where2)->select();
        $count = count($result);

        $comments = D('comments');
        for($i = 0; $i < $count; $i++){
           // 去除内容中的html标签
           $result[$i]['posts_content'] = strip_tags($result[$i]['posts_content']);
           // 查询每篇帖子都有几条评论
           $wh['posts_id'] = $result[$i]['posts_id'];
           $res = $comments->where($wh)->order('comments_time desc')->select();
           $result[$i]['coms_num'] = count($res);
        }

        $where3['user_id'] = $user['user_id'];
        $result2 = $comments->where($where3)->select();
        $num = count($result2);
        for($i = 0; $i < $num; $i++){
          $result2[$i]['username'] = $user['username'];
          $we['posts_id'] = $result2[$i]['posts_id'];
          $re = $posts->where($we)->order('posts_time desc')->find();
          $result2[$i]['posts_title'] = $re['posts_title'];
        }
        //var_dump($result);
        $this->assign('comments', $result2);
        $this->assign('result', $result);

        $this->assign('user', $user);
        $this->display();
     }else{
        $this->display('404');
     }
  }
  public function showFollow(){
      if($_GET['type'] && $_GET['userid']){
        $type = $_GET['type'];
        $where['user_id'] = $_GET['userid'];
        $user = M('users');
        if($type === 'follows'){
          $result = $user->where($where)->getField('follows');
        }else if($type === 'followers'){
          $result = $user->where($where)->getField('followers');
        }
        $array = explode(",", $result);
        $num = count($array);
        for($i = 0; $i < $num; $i++){
          $wh['user_id'] = $array[$i];
          $users[$i] = $user->where($wh)->find();
        }
        //var_dump($users);
        $this->assign('users', $users);
        $this->display('follow');
      }else{
        $this->display('404');
      }
    }
    // 删除帖子
    public function delUserPost(){
      $where['posts_id'] = I('post.id','','');
      $num = I('post.num','','');
      $model = D('posts');
      $coms = D('comments');
      $result_2 = 1;
      if($num > 0){
        $result_2 = $coms->where($where)->delete();
      }
      $result = $model->where($where)->delete();
      if($result && $result_2){
        $this->ajaxReturn('删除成功！');
      }else{
        $this->ajaxReturn('删除失败，请重试！');
      }
    }
    // 删除评论
    public function delUserCom(){
      $where['comments_id'] = I('post.id','','');
      $coms = D('comments');
      $result = $coms->where($where)->delete();
      if($result){
        $this->ajaxReturn('删除成功！');
      }else{
        $this->ajaxReturn('删除失败，请重试！');
      }
    }
    // 管理用户页面end

    //退出登录
    public function logout(){
        session(['destroy']);
        $this->success('退出登陆', U('Login/index'));
    }
}
