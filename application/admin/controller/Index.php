<?php
namespace app\admin\controller;
use think\Controller;

class Index extends controller
{
    public function index()
    {
      return $this->fetch();
    }


    public function welcome(){
 

    	return "<h2 class='text-center '>欢迎来到管理页面</h2>";
    }

    public function test(){
        //$s=\Map::staticimage('广西壮族自治区南宁市东葛路');
    	//return  $s;
    	//$map = new \Map();
    	//var_dump($map);
        
       /*$res=\phpmailer\Email::send('616364596@qq.com','这次是标题啊',"内容1111");
        if ($res) {
        	return '发送成功';
        	exit();
        }else{
        	return 'wrong';
        }*/


    }
    
    public function map(){
        $s=\Map::getLngLat('广西壮族自治区南宁市东葛路');
    	// $map = new \Map();
    	// $s=$map->getLngLat('广西壮族自治区南宁市东葛路');
    	echo $s;
    }

    public function staticimage(){
           $s=\Map::staticimage('广西壮族自治区南宁市东葛路');
    	   return  $s;
    	//$map = new \Map();
    	//var_dump($map);
    }









}
