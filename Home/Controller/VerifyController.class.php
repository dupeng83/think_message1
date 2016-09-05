<?php
namespace Home\Controller;
use Think\Controller;
class VerifyController extends Controller 
{
	public function veri()
	{
		$config = ['length' => 2] ;  // 验证码位数   
		

		$Verify = new \Think\Verify($config);
		$Verify->entry();
	}

	/*public function veri2()
	{
		$config = ['length' => 1,] ;  // 验证码位数   
		

		$Verify = new \Think\Verify($config);
		$Verify->entry(2);
	}*/

	


}