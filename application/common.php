<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件
function status($status)
{
if ($status==1) {
	$str="<span class='label label-success radius'>正常</span>";
}elseif ($status==0) {
	$str="<span class='label label-success radius'>待审</span>";
}else{
	$str="<span class='label label-success radius'>删除</span>";
}
return $str;
}


//获取
function curl($url,$type=0,$data=[]){
     $ch=curl_init(); //初始化
     curl_setopt($ch, CURLOPT_URL, $url);
     curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
     curl_setopt($ch, CURLOPT_HEADER, 0);

     if ($type==1) {
     curl_setopt($ch, CURLOPT_POST, 1);
     curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
     }

     //执行并获取内容
     $output =curl_exec($ch);
     //释放curl句柄
     curl_close($ch);
     return $output;
}

function show($status,$message='',$data=[]){

  return [
     'status'  => intval($status),
     'message' => $message,
     'data'    => $data
   ];
}

//商户入驻申请的文案
function bisRegister($status){
   if ($status==1) {
       $str = '审核通过';
   }elseif ($status==0) {
       $str = '正在审核中，审核后平台会发邮件通知，请关注邮箱信息';
   }elseif($status==2){
       $str = '非常抱歉，您提交的材料不合条件，请重新提交';
   }else{
       $str = '该申请已被删除';
   }
   echo $str;

}

//通用的分页样式
function pagination($obj){
  if (!$obj) {
    return '';
  }

  return '<div class="cl pd-5 bg-1 bk-gray mt-20">'.$obj->render().'</div>';
}

//获取二级城市名称
function getSeCityName($path){
  
   if (empty($path)) {
     return '';
   }

  //这样确定是二级分类
   if (preg_match('/,/', $path)) {
      $cityPath = explode(',', $path);
      $cityId   = $cityPath[1];
   }else{
       $cityId   = $path;
   }

   $city = model("City")->get($cityId);
   return $city->name;

}

//获取二级分类名称
function getSeCategoryName($path){
  
   if (empty($path)) {
     return '';
   }

  //这样确定是二级分类
   if (preg_match('/,/', $path)) {
      $categoryPath = explode(',', $path);
      $categoryId  = $categoryPath[1];
   }else{
       $categoryId   = $path;
   }

   $category = model("Category")->get($categoryId);
   return $category->name;

}
