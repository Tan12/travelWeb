<?php
namespace Home\Controller;
use Think\Controller;
class CommonController extends Controller {
	protected $userInfo = false; // 用户是否登录
	// 构造方法
	public function __construct(){
		parent::__construct();
		$this->checkUser();
	}
	// 检查登录
	private function checkUser(){
		if(session('?user_id')){
			$userinfo = array(
				'mid' => session('user_id'),
				'mname' => session('username')
			);
			$this->userInfo = $userinfo;
			$this->assign($userinfo); //为模板分配用户信息变量
		}
	}
}