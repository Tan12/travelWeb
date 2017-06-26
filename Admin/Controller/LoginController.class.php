<?php
namespace Admin\Controller;
header("Content-type:text/html;charset=utf8");
use Think\Controller;
class LoginController extends Controller {
    public function index(){
        if(IS_POST){
            $rst = $this->checkVerify(I('post.verify'));
            if(!$rst){
                $this->error('验证码错误');
            }
            if(I('post.name') && I('post.pwd')){
                $model = D('admin');
                $result = $model->select();
                $name = I('post.name',' ','trim');
                $pwd = I('post.pwd',' ','trim');
                if($name === $result[0]['name'] && $pwd === $result[0]['pwd']){
                    session('name',$name);
                    $this->success('登录成功，请稍等', U('Index/index'));
                }else{
                    $this->error('登陆失败，用户名或密码错误');
                }
            }
            return;
        }
        $this->display();
    }
    //生成验证码
    public function getVerify(){
        $config = array(
            'fontSize' => 18,
            'length' => 4,
            'useCurve' => false,
        );
        $verify = new \Think\Verify($config);
        return $verify->entry();
    }
    //检查验证码
    private function checkVerify($code, $id='') {
        $verify = new \Think\Verify();
        return $verify->check($code,$id);
    }
}