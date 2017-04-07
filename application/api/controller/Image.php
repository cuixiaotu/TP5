<?php
namespace app\api\controller;
use think\Controller;
use think\File;
use think\Request;

class Image extends Controller
{
    public function upload(){
       $file=Request::instance()->file('file');
        //定义图片位置
       $info=$file->move('upload');
      // print_r($info);
       if ($info&&$info->getPathName()) {
          return show(1,"success","/".$info->getPathName());      
       }

      return show(0,"error"); 

    }


}
