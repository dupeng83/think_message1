<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller 
{
    public function index()
    {
        dump($_SESSION);
        if(!isset($_SESSION['username']))
        {
        	$this->redirect('Login/login');
        }

        if(IS_POST)
        {
        	echo 'post';
            $upload = new \Think\Upload();// 实例化上传类    
            $upload->maxSize = 3145728 ;//设置附件上传大小
            // 设置附件上传类型   
            $upload->exts = array('jpg', 'gif', 'png', 'jpeg');
            // $upload->savePath = './Public/'; //设置附件上传目录

            // dump($upload); exit;  
            // 上传文件     
            $info = $upload->upload();
            dump($info); exit;    
            if(!$info) 
            {   // 上传错误提示错误信息        
                $this->error($upload->getError());    
            }
            else
            {   // 上传成功        
                $this->success('上传成功！');    
            }
        }

        // $mess = D('message');
        // dump($mess); exit;
        // exit;
        $list = D('Message')->select();
        // dump($list); exit;
        $this->list = $list;
        $this->display();
    }



}