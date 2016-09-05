<?php
namespace Home\Controller;
use Think\Controller;
class RegisterController extends Controller 
{
    public function regi()
    {
    	dump($_POST);
    	if (IS_POST) 
        {
    		$username = I('post.username');
    		$password = I('post.password');
    		$password1 = I('post.password1');
    		$sex = I('post.sex');
    		$info = D('User') -> checkRegister($username,$password,$password1,$sex);

            //如果存入数据库成功,也就是注册成功
            if($info['status'])
            {
                //写入SESSION
                $_SESSION['username'] = $username;
                $this->redirect('Index/index', [], 5, '注册成功...');
            }
            //否则还是显示注册页
            else
            {
                $this -> assign('info', $info);
                $this -> display();
            }
    	}

        else
        {
            $this->display();
        }
    	// $this->display();
    	// echo 'pulupulu';
    }
}