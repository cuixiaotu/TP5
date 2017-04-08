<?php
namespace app\bis\controller;
use think\Controller;

class Location extends Base{

	
    public function index(){

      return $this->fetch();
    }

    public function add(){
      //获取一级城市的数据
      $citys = model('City')->getNormalCityByParentId();
      $this->assign('citys',$citys);

      //获取一级分类的数据
      $categorys = model('Category')->getNormalCategoryByParentId();
      $this->assign('categorys',$categorys);


      return $this->fetch();
    }



}
