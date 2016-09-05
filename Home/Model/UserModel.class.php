<?php
namespace Home\Model;
use Think\Model;
class UserModel extends Model {
	public function doNothing(){

	}

	//检查用户名密码是否正确
	public function loginCheck($username,$password)
	{
		$condition['username'] = $username;
		$result = $this -> where($condition) ->find();
		// dump($result); exit;
		if(!$result)
		{
			return false;
		}
		elseif($result['password'] == md5($password))
		{
			// dump($result);exit;
			return true;
		}
	}

	//新用户注册
	public function checkRegister($username,$password,$password1,$sex)
	{
		//假定两个password一样
		//检查用户名是不是用过了
		$condition['username'] = $username;
		$result = $this -> where($condition) -> find();
		// dump($result);exit;
		if ($result) 
		{
			$info['status'] = 0;
			$info['describe'] = '用户名不可用';
			return $info;
		}
		else
		{
			//存入数据库
			$data['username'] = $username;
			$data['password'] = md5($password);
			$data['sex'] = $sex == 'm' ? 1:0;
			$this -> add($data);

			$info['status'] = 1;
			return $info;
		}

	}


}