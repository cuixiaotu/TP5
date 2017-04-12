<?php
namespace app\common\model;
use think\Model;

class BisLocation extends BaseModel{
   
   public function getLocationByBisId($id){
     //通过id获取商家店面
   	 $data  = ['bis_id'=>$id];
   	 $order = ['id' => 'asc'];
     $res   = $this->where($data)->order($order)->paginate(5);
     return  $res;
   }

   public function getNormalLocationByParentId($bisid){
     //通过id获取商家店面
   	 $data  = ['bis_id'=>$bisid,'status'=>1];
     $res   = $this->where($data)->order('id')->select();
     return  $res;
   }

      
  

}