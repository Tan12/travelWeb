<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends CommonController {
	public function __construct(){
		parent::__construct();
		$allow_action = array( // 指定需要检查登录的方法
			'mycenter'
		);
		if(!$this->userInfo && in_array(ACTION_NAME, $allow_action)){
			$this->error('请先登录！', U('Index/login'));
		}
	}

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
    public function showNew(){
       if(IS_GET){
           $id = $_GET['id'];
           $model = D('news');
           $where['news_id']=$id;
           $result = $model->where($where)->find();
           $this->assign('result', $result);
           $this->display('new');
       }else{
           $this->display('404');
       }
    }

    // 显示攻略页面
    public function tips(){
    	$model = D('tips');
    	$result = $model->order('tips_time desc')->select();
    	$count = count($result);
      	for($i = 0; $i < $count; $i++){
       	 // 去除内容中的html标签
           $result[$i]['tips_content'] = strip_tags($result[$i]['tips_content']);
      	}
    	$this->assign('result', $result);
    	$this->display('tips');
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

    // 显示文章详情
    public function message(){
       if(IS_GET){
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

    // 景点介绍
    public function views(){
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
	// 景点详情
	public function view(){
		if($_GET['id']){
			$id = $_GET['id'];
			$model = D('sights');
			$where['sights_id']=$id;
			$result = $model->where($where)->order('sights_id desc')->find();
			$this->assign('result', $result);
			$this->display('view');
		}else{
			$this->display('404');
		}
	}

	// 显示社区页面
	public function chat(){
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

	// 添加帖子
	public function addPost(){
		$data['posts_title'] = I('post.title','','');
		$data['posts_content'] = I('post.content','','');
		$data['posts_author'] = I('post.author','','');
		$data['posts_time'] = date("Y-m-d H:i:s");
	    $model = M('posts');
	    $result = $model->data($data)->add();
	    $msg = $result ? "发表成功！" : "发表失败，请重试！";
	    $this->ajaxReturn($msg);
	}
	// 查看帖子
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
	// 搜索帖子
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
	// 添加评论
	public function addCom(){
		$data['com_content'] = I('post.content','','');
		$data['posts_id'] = I('post.post','','');
		$data['user_id'] = I('post.author','','');
		$data['comments_time'] = date("Y-m-d H:i:s");
	    $model = M('comments');
	    $result = $model->data($data)->add();
	    $msg = $result ? "发表成功！" : "发表失败，请重试！";
	    $this->ajaxReturn($msg);
	}

	// 用户登录
	public function login(){
		$this->display();
	}
	public function checkLogin(){
		$warning = $this->checkVerify(I('post.verify'));
		if($warning === 'ok'){
			$name = I('post.name','','');
			$pwd = I('post.pwd','','');

			$model=D('users');
		    $where['username'] = $name;
			$data = $model->where($where)->find();
			if(!$data){
				$warning = '用户名不存在！';
			}else if($data['pwd'] !== $pwd){
			    $warning =  '密码错误！';
			}else{
				session('username', $name);
				session('user_id', $data['user_id']);
				$warning =  '登录成功！';
			}
		}
		$this->ajaxReturn($warning);
	}
	// 退出登录
	public function logout(){
		//session(['destroy']);
		$_SESSION = array(); //清除SESSION值.
        if(isset($_COOKIE[session_name()])){  //判断客户端的cookie文件是否存在,存在的话将其设置为过期.
           setcookie(session_name(),'',time()-1,'/');
        }
        session_destroy();  //清除服务器的sesion文件
        $this->success('退出登陆', U('Index/index'));
	}

	// 用户注册
  	public function register(){
		$data['username'] = I('post.name','','');
		$data['email'] = I('post.email','','');
		$data['pwd'] = I('post.pwd','','');
		$data['img'] = 'default.gif';

		$model=M('users');
		$where['username'] = $data['username'];
		$result = $model->where($where)->find();
		if($result){
			$warning = '用户名已存在！';
		}else{
			$re = $model->data($data)->add(); // 如果主键是自动增长型 成功后返回值就是最新插入的值
			if($re){
				session('username', $data['username']);
				session('user_id', $re);
				$warning =  '注册成功！';
			}else{
				$warning =  '注册失败，请重试！';
			}
		}
		$this->ajaxReturn($warning);
    }

    // 用户中心
    public function user(){
    	if($_GET['name']){
	        $name = $_GET['name'];
	        $model = D('users');
	        $where['username']=$name;
	        $user = $model->where($where)->find();
	        $follows = $user['follows'] ? explode(",", $user['follows']) : [];
	        $followers = $user['followers'] ? explode(",", $user['followers']) : [];
	        $user['follow_num'] = count($follows);
	        $user['follower_num'] = count($followers);

	        // 判断当前用户是否关注了ta
	        $me_id = session('user_id');
	        if(in_array($me_id, $followers)){
	        	$user['flag'] = 'follow';
	        	//var_dump($user);
	        }

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
	           $res = $comments->where($wh)->select();
	           $result[$i]['com_num'] = count($res);
	      	}

	      	$where3['user_id'] = $user['user_id'];
			$result2 = $comments->where($where3)->select();
			$num = count($result2);
			for($i = 0; $i < $num; $i++){
				$result2[$i]['username'] = $user['username'];
				$we['posts_id'] = $result2[$i]['posts_id'];
				$re = $posts->where($we)->find();
				$result2[$i]['posts_title'] = $re['posts_title'];
			}
			//var_dump($result);
			$this->assign('comments', $result2);
	    	$this->assign('result', $result);

	        $this->assign('user', $user);
	        $this->display('user');
	     }else{
	        $this->display('404');
	     }
    }
    public function follow(){
    	$follow = I('post.follow','',''); // 被关注者id
		$follower = I('post.follower','',''); // 关注者id
		$tag = I('tag','','');
		$users = M('users');
		$wh_1['user_id'] = $follower;
		$wh_2['user_id'] = $follow;
		$me = $users->where($wh_1)->getField('follows');
		$ta = $users->where($wh_2)->getField('followers');
		if($tag === 'follow'){ //关注
			$me = $me ? $me.','.$follow : $follow;
			$ta = $ta ? $ta.','.$follower : $follower;
			$re_1 = $users->where($wh_1)->setField('follows', $me);
			$re_2 = $users->where($wh_2)->setField('followers', $ta);
			if($re_1 && $re_2){
				$info = '关注成功！';
			}else{
				$info = '关注失败，请重试！';
			}
		}
		if($tag === 'nofollow'){ // 取消关注
			$array_me = explode(",", $me);
		    $array_ta = explode(",", $ta);

			$where_me = array_keys($array_me, $follow)[0];
			array_splice($array_me, $where_me, 1); // 取消关注
			$me = implode(",", $array_me);
			$re_1 = $users->where($wh_1)->setField('follows', $me);

			$where_ta = array_keys($array_ta, $follower)[0];
			array_splice($array_ta, $where_ta, 1); // 删掉粉丝
			$ta = implode(",", $array_ta);
			$re_2 = $users->where($wh_2)->setField('followers', $ta);
			if($re_1 && $re_2){
				$info = "取消关注成功！";
			}else{
				$info = "取消关注失败，请重试！";
			}
		}
		$this->ajaxReturn($info);
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

    // 显示个人中心
    public function mycenter(){
    	$users = D('users');
	    $where1['username'] = session('username');
		$user = $users->where($where1)->find();
		$follows = $user['follows'] ? explode(",", $user['follows']) : [];
        $followers = $user['followers'] ? explode(",", $user['followers']) : [];
        $user['follow_num'] = count($follows);
        $user['follower_num'] = count($followers);
        //var_dump($user);

		$posts = D('posts');
	    $where2['posts_author'] = session('username');
		$result = $posts->where($where2)->order('posts_time desc')->select();
    	$count = count($result);

      	$comments = D('comments');

      	for($i = 0; $i < $count; $i++){
       		// 去除内容中的html标签
           $result[$i]['posts_content'] = strip_tags($result[$i]['posts_content']);
           // 查询每篇帖子都有几条评论
           $wh['posts_id'] = $result[$i]['posts_id'];
           $res = $comments->where($wh)->select();
           $result[$i]['com_num'] = count($res);
      	}

      	$where3['user_id'] = session('user_id');
		$result2 = $comments->where($where3)->order('comments_time desc')->select();
		$num = count($result2);
		for($i = 0; $i < $num; $i++){// 查询每条评论都来自哪
			$result2[$i]['username'] = $user['username'];
			$we['posts_id'] = $result2[$i]['posts_id'];
			$re = $posts->where($we)->find();
			$result2[$i]['posts_title'] = $re['posts_title'];
		}
		//var_dump($result);
		$this->assign('comments', $result2);
    	$this->assign('result', $result);
		$this->assign('user', $user);
    	$this->display();
    }
    // 修改密码
    public function editPwd(){
    	$oldPwd = I('post.oldpwd','','');
		$newPwd = I('post.newpwd','','');

	    $where['username'] = session('username');
	    $model = M('users');
		$user = $model->where($where)->find();
		if($oldPwd === $user['pwd']){
			$res = $model->where($where)->setField('pwd', $newPwd);
			$info = $res ? '修改成功！' : '修改失败，请重试！';
		}else{
			$info = '旧密码错误，请重试！';
		}
		$this->ajaxReturn($info);
    }
    // 修改资料
    public function editInfo(){
    	$model=M('users');
    	if($_POST['username']){
			$data['username'] = $_POST['username'];
			$where['username'] = $data['username'];
			$result = $model->where($where)->find();
			if($result){
				$this->ajaxReturn('用户名已存在！');
				exit;
			}
		}
		if($_POST['userid']){
			$data['user_id'] = $_POST['userid'];
		}
		if($_POST['email']){
			$data['email'] = $_POST['email'];
		}
		if($_FILES['pic']['name']){
			$file = $_FILES['pic'];
			$name = $file['name'];
			$filename = time().substr($name, strrpos($name,'.'));
			$type = strtolower(substr($name,strrpos($name,'.')+1));

			$upload_path = './Public/userImgs/';
			$randname=time().rand(100, 999).'.'.$type;
			if(move_uploaded_file($file['tmp_name'], $upload_path.$randname)){
				$data['img'] = $randname;
			}else{
			    $this->ajaxReturn('图片上传出错，请重试！');
			    exit;
			}
		}
		$re = $model->save($data);
		if($re){
			$info = '修改成功！';
			if($data['username']){
				session('username', $data['username']);
			}
		}else{
			$info = '修改失败，请重试！';
		}
		$this->ajaxReturn($info);
    }
    // 删除帖子
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

	// 生成验证码
	public function captcha(){
		$config = array(
            'fontSize' => 18,
            'length' => 4,
            'useCurve' => false
        );
		$verify = new \Think\Verify($config);
		echo $verify;
        return $verify->entry();
	}
	// 检查验证码
	public function checkVerify($code, $id='') {
        $verify = new \Think\Verify();
		$rst = $verify->check($code, $id);
        if(!$rst){
			return '验证码输入有误！';
		}
		return 'ok';
    }
}
