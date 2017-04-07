<?php
namespace app\common\model;

use think\Model;

class City extends Model
{
   
     public function getNormalCityByParentId($parentId=0){
     	$data=[
             'status' => 1,
             'parent_id' =>$parentId,
     	      ];
     	$order=[
              'id' =>'asc'
     	       ];
     return $this->where($data)->order($order)->select();
    }
      
    public function getFirstCategory($parent_id=0){
      	$data=[
             'status' => ['neq',-1],
             'parent_id' =>$parent_id,
     	      ];
     	$order=[
              'listorder'=>'desc',

     	       ];   
     $res= $this->where($data)->order($order)->paginate(); 
    // echo $this->getLastSql();	
     return $res;       	
    }

}