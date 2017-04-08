<?php
namespace app\common\model;

use think\Model;

class BisAccount extends BaseModel
{
 
        //通过id上传数据
  public function updateById($data,$id){
   	//allowField 过滤数组
     $res = $this->allowField(true)->save($data,['id'=>$id]);
     return  $res;
  }  
  

}