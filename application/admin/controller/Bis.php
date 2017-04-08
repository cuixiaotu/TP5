<?php
namespace app\admin\controller;
use think\Controller;


class Bis extends Controller
{

   private $obj;
   public function _initialize(){
    $this->obj=model('Bis');
   }

   /*商户列表*/
   public function index(){
   $bis=$this->obj->getBisByStatus(1);
   $this ->assign("bis",$bis);
   return $this->fetch();
   }

   /*入驻申请*/
   public function apply(){
      $bis =$this->obj->getBisByStatus();
      $this ->assign("bis",$bis);
      return $this->fetch();
    }

   /*已删除商户*/
   public function dellist(){
      $bis =$this->obj->getBisByStatus(-1);
      $this ->assign("bis",$bis);
      return $this->fetch();
    }

    /*商户详情页*/
    public function detail(){
     $id=input('get.id');
     if (empty($id)) {
        return $this ->error('ID错误');
     }

     
    //获取一级城市的数据
      $citys = model('City')->getNormalCityByParentId();
      $this->assign('citys',$citys);

    //获取一级分类的数据
      $categorys = model('Category')->getNormalCategoryByParentId();
      $this->assign('categorys',$categorys);

     //获取商户信息
      $bisData = model('Bis')->get($id);
      $locationData = model('BisLocation')->get(['bis_id'=>$id,'is_main'=>1]);
      $accountData = model('BisAccount')->get(['bis_id'=>$id,'is_main'=>1]);

      $this->assign('bisData',$bisData);
      $this->assign('locationData',$locationData);
      $this->assign('accountData',$accountData);

      return $this->fetch();
    }
   


  //更改状态
   public function status(){

   //var_dump(input("get."));

   $data = input('get.');
   // $validate = validate('Bis');
  
   //  /*场景设置  增加校验机制*/

   //  if (!$validate->scene('status')->check($data)) {
   //    $this->error($validate->getError());
   // }
   
    $res=$this->obj->save(['status'=>$data['status']],['id'=>intval($data['id'])]);
    $location=model('BisLocation')->save(['status'=>$data['status']],['bis_id'=>intval($data['id']),'is_main'=>1]);
    $account =model('BisAccount')->save(['status'=>$data['status']],['bis_id'=>intval($data['id']),'is_main'=>1]);

   

   if ($res&&$location&&$account) {
    //发送邮件
    //status 1通过     -2不通过      -1删除

     // 发送邮件给客户    通知客户 账户验证状态
    // if ($data['status']==1 ){
    //    $url    = request()->domain().url('bis/register/checkstatus',['id' =>$$data['id']]);
    //    $content= "您提交的入驻申请已经通过申请，您可以通过点击链接<a href='".$url."' target='_blank'>查看链接</a>查看审核状态";
    // }elseif ($data['status']== -2) {
    //    $url    = request()->domain().url('bis/register/checkstatus',['id' =>$$data['id']]);
    //    $content= "您提交的入驻申请未通过申请，您可以通过点击链接<a href='".$url."' target='_blank'>查看链接</a>查看审核状态";
    // }elseif ($data['status']== -1) {
    //    $url    = request()->domain().url('bis/register/checkstatus',['id' =>$$data['id']]);
    //    $content= "您提交的入驻申请已经被删除，您可以通过点击链接<a href='".$url."' target='_blank'>查看链接</a>查看审核状态";
    // }else{
    //   $content= "您提交的入驻申请需出现未知的错误，请联系管理员";
    // }
      
    //    $to     = $data['email'];
    //    $title  = "o2o入住审核结果";
       
    //    \phpmailer\Email::send($to,$title,$content);

     $this ->success('状态更新成功');
   }else{
     $this->error('状态更新失败');
   }

   }

    

}
