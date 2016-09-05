<?php
namespace Home\Controller;
use Think\Controller;
class LoginController extends Controller 
{
	public function login()
	{
		//已经登录直接跳转
		if (isset($_SESSION['username'])) {
			$this->redirect('Index/index', [], 5, '已经登录了...');
		}

		if(IS_POST)
		{
			dump($_POST);
			dump($_SESSION);

			//看验证码对不对
			$verifyCode = I('post.code');
			// $verifyCode2 = I('post.code2');
			// dump($verifyCode);
			// dump($verifyCode2);
			// echo "<hr>";
			if(!($this->check_verify($verifyCode)))
			{
				$this->verifyCodeMistake = 1;
				$this -> display();
				return;
			}
			// $this->check_verify($verifyCode,2);
			
			$username = I('post.username');
			$password = I('post.password');

			//检查用户名密码是否正确
			if(D('User') -> loginCheck($username,$password))
			{
				$_SESSION['username'] = $username;
				$this -> redirect('Index/index');
			}
			else
			{
				$this->pwdMistake = 1;
				$this -> display();
				return;
			}			

		}
		else
		{
			$this->display();
		}
	}

	// 检测输入的验证码是否正确，$code为用户输入的验证码字符串 
	public function check_verify($code, $id = '')
	{ 
		$verify = new \Think\Verify();    
		$result= $verify->check($code, $id);
		// dump($result);exit;
		return $result;
	}

	public function logout()
	{
		 $_SESSION=[];
		 

		 $this->redirect('Index/index');
	}



}