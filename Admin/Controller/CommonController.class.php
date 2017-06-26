<?php
namespace Admin\Controller;
use Think\Controller;
class CommonController extends Controller {
	public function __construct(){
		parent::__construct();
		$this->checkUser();
	}
	private function checkUser(){
		if(!session('?name')){
			$this->error('请登录',U('Login/index'));
		}
	}
}