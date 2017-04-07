<?php
namespace app\common\model;

use think\Model;

class Category extends Model
{
     public function add($data){
     $data['status']=1;
     $data['create_time']=time();
     return $this->save($data);
     }

     public function getNormalFirstCategory(){
     	$data=[
             'status' => 1,
             'parent_id' =>0,
     	      ];
     	$order=[
              'id' =>'desc'
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

    public function getNormalCategoryByParentId($parentId=0){
      $data=[
             'status' => 1,
             'parent_id' =>$parentId,
            ];
      $order=[
              'id' =>'asc'
             ];
     return $this->where($data)->order($order)->select();
    }





}