<?php
namespace app\api\controller;
use think\Controller;

class City extends Controller
{
    private $obj;
    public function _initialize(){
    	$this->obj=model("City");
    }

    public function getCitysByParentId(){
      $id=input('post.id');
      if(!$id){
      	$this->error('ID不合法');
      }
      //通过id 获取二级城市
      $citys =$this->obj->getNormalCityByParentId($id);
      // return $citys;
       if(!$citys){
      	return show(0,'error','');
      	exit();
      }      
       return show(1,'success',$citys);
       //return $citys;
    }



    




}
