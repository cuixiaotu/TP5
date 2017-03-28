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
    

}
