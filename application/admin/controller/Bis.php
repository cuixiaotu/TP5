<?php
namespace app\admin\controller;
use think\Controller;


class Bis extends Controller
{

   private $obj;
   public function _initialize(){
    $this->obj=model('Bis');
   }

  /*
   *入驻申请
   */

    public function apply(){
      $bis =$this->obj->getBisByStatus();
     
      $this ->assign("bis",$bis);
      return $this->fetch();
    }


   

    

}
