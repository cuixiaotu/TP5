<?php
namespace app\common\model;

use think\Model;

class Bis extends BaseModel
{

  //通过状态获取商家数据
  public function getBisByStatus($status=0){
  	 $order = ['id' => 'desc'];
     $data  = ['status' => $status];
     $res = $this->where($data)->order($order)->paginate(5);
     return  $res;
  }
      
  //通过id上传数据
  public function updateById($data,$id){
   	//allowField 过滤数组
     $res = $this->allowField(true)->save($data,['id'=>$id]);
     return  $res;
  }  

}