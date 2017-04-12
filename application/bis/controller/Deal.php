<?php
namespace app\bis\controller;
use think\Controller;

class Deal extends Base{

    public function index(){

    $bisId=$this->getLoginUser()->bis_id;
    $deals=model('Deal')->getBisDealByBisId($bisId);
    $this->assign('deals',$deals);
    //var_dump($deals);
    return $this->fetch();
    }

    public function add(){

      if (request()->isPost()) {
      	//插入数据逻辑
        $data=input("post.");
        //tp5的验证机制
         
        $bisId    = $this->getLoginUser()->bis_id;
        $location = model('BisLocation')->get($data['location_ids'][0]);
        //再保存入库
        $deals=[
           'bis_id'   => $bisId,
           'name'     => $data['name'],
           'city_id'  => $data['city_id'],
           'category_id'  => $data['category_id'],
           'se_category_id'  => empty($data['se_category_id'])?'':implode(',',$data['se_category_id']),
           'location_ids'  => empty($data['location_ids'])?'':implode(',',$data['location_ids']),
           'image'  => $data['image'],
           'start_time'  => strtotime($data['start_time']),
           'end_time'  => strtotime($data['end_time']),
           'total_count'  => $data['total_count'],
           'origin_price'  => $data['origin_price'],
           'current_price'  => $data['current_price'],
           'coupons_begin_time'=> strtotime($data['coupons_begin_time']),
           'coupons_end_time'=> strtotime($data['coupons_end_time']),
           'description'=> trim($data['description']),       
           'notes'    => trim($data['notes']),
           'bis_account_id'    => $bisId,
           'xpoint' =>$location->xpoint,
           'ypoint' =>$location->ypoint,

        ];

          // var_dump( $deals);exit();

           $id= model('Deal')->add($deals);
           if ($id) {
           	$this->success("添加成功",url("deal/index"));
           }else{
           	$this->error("添加失败");
           }


      }else{
      //获取一级城市的数据
      $citys = model('City')->getNormalCityByParentId();
      $this->assign('citys',$citys);

      //获取一级分类的数据
      $categorys = model('Category')->getNormalCategoryByParentId();
      $this->assign('categorys',$categorys);
        
      $bisId=$this->getLoginUser()->bis_id;  
      $bislocations =model('bisLocation')->getNormalLocationByParentId($bisId);
      //var_dump($bislocations);
      $this->assign('bislocations',$bislocations);
      return $this->fetch();
      }

    }

    public function edit(){

    //获取一级城市的数据
    $citys = model('City')->getNormalCityByParentId();
    $this->assign('citys',$citys);

    //获取一级分类的数据
    $categorys = model('Category')->getNormalCategoryByParentId();
    $this->assign('categorys',$categorys);

    $bisId=$this->getLoginUser()->bis_id;  
    $bislocations =model('bisLocation')->getNormalLocationByParentId($bisId);
    //var_dump($bislocations);
    $this->assign('bislocations',$bislocations);

    $id=input("get.id");
    $deal=model("Deal")->getDealById($id);
    $this->assign('deal',$deal);
    //var_dump($deal);
    return $this->fetch();
    }



    //删除分店
    public function status(){
     //获取当前门店的信息
    $id=input("get.id");
   
    $res=model("Deal")->save(['status'=> -1],['id'=>intval($id)]);
    return $this->fetch();
    }





}
