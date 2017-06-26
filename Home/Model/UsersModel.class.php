<?php
namespace Home\Model;
use Think\Model;
class UsersModel extends Model{
	public function checkUser($name, $pwd){
		$data = $this->field('user_id,username,pwd')->where(array('username'=>$name))->find();
		if($data === null){
			return '用户名不存在';
		}
		if($data['pwd'] === $pwd){
			session('username', $name);
			session('user_id', $data['user_id']);
			session('pwd', $data['pwd']);
			return true;
		}
		return '密码错误';
	}
}