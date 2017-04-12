<?php
namespace app\common\model;
use think\Model;

class Deal extends BaseModel{

  //通过状态获取商家数据
  public function getBisByStatus($status=0){
  	 $order = ['id' => 'desc'];
     $data  = ['status' => $status];
     $res = $this->where($data)->order($order)->paginate(5);
     return  $res;
  }


  //通过商家id获取该商家各种商品信息
  public function getBisDealByBisId($bisId){
     $order = ['id' => 'desc'];
     $data  = ['bis_id' => $bisId];
     $res = $this->where($data)->order($order)->paginate(5);
     return  $res;
  }

  //通过id获取该团购信息
  public function getDealById($id){
     $data  = ['id' => $id];
     $res = $this->where($data)->find();
     return  $res;
  }  


   


}