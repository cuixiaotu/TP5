<?php
namespace app\bis\controller;
use think\Controller;

class Location extends Base{

	
    public function index(){
     $bisId=$this->getLoginUser()->bis_id;
     $location=model("BisLocation")->getLocationByBisId($bisId);
     $this ->assign("location",$location);

     return $this->fetch();
    }

    public function add(){
      
      if (request()->isPost()) {
      	//商户基本信息入库 
         $data=input('post.');
      	//父类  Base里的方法
        $bisId=$this->getLoginUser()->bis_id;

        $data['cat']='';
         if (!empty($data['se_category_id'])) {
         	//$data['category_id']:$data['category_id']
         	$data['cat']=implode("|",$data['se_category_id']);
         }

        //获取经纬度
        $lnglat = \Map::getLngLat($data['address']);
        //var_dump($lnglat);
        if (empty($lnglat)||$lnglat['status']!=0||$lnglat['result']['precise']!=1) {
       	  $this->error('无法获取数据，或者匹配地址不精确');
        }

        $locationData = [
          'bis_id'    =>  $bisId,        //总店ID
          'name'      =>  $data['name'],
          'logo'      =>  $data['logo'],
          'tel'       =>  $data['tel'],
          'contact'   =>  $data['contact'],
          'category_id' =>$data['category_id'],
          'category_path' =>$data['category_id'].','.$data['cat'],
          'city_id'   =>  $data['city_id'],
          'city_path' =>  empty($data['se_city_id'])?$data['city_id']:$data['city_id'].','.$data['se_city_id'],
          'address'   =>  $data['address'],
          'api_address'   =>  $data['address'],
          'open_time' =>  $data['open_time'],
          'content'   =>  empty($data['content'])?'':trim($data['content']),
          'is_main'   =>  0,  //表示分店信息
          'xpoint'    => empty($lnglat['result']['location']['lng'])?'': $lnglat['result']['location']['lng'],
          'ypoint'    => empty($lnglat['result']['location']['lat'])?'': $lnglat['result']['location']['lat'],
       ]; 
       $locationId= model('BisLocation')->add($locationData);

       if ($locationId) {
          return $this->success('门店申请成功');
       }else{
       	  return $this->success('门店申请成功');
       }

      }else{
      //获取一级城市的数据
      $citys = model('City')->getNormalCityByParentId();
      $this->assign('citys',$citys);

      //获取一级分类的数据
      $categorys = model('Category')->getNormalCategoryByParentId();
      $this->assign('categorys',$categorys);

      return $this->fetch();
     }

    }

    //获取页面
    public function edit(){

     //获取一级城市的数据
     $citys = model('City')->getNormalCityByParentId();
     $this->assign('citys',$citys);

     //获取一级分类的数据
     $categorys = model('Category')->getNormalCategoryByParentId();
     $this->assign('categorys',$categorys);

     //获取当前门店的信息
     $locationId=input("get.id");
     $location  =model("BisLocation")->getLocationByLocationId($locationId);
     $this->assign('location',$location);

     return $this->fetch();
    }

    //删除分店
    public function status(){

     //获取当前门店的信息
     $locationId=input("get.id");
   
     $res=model("BisLocation")->save(['status'=> -1],['id'=>intval($locationId)]);


     return $this->fetch();
    }





}
