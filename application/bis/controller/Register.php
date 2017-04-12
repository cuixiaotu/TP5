<?php
namespace app\bis\controller;
use think\Controller;

class Register extends controller
{

    public function index(){

      //获取一级城市的数据
      $citys = model('City')->getNormalCityByParentId();
      $this->assign('citys',$citys);

      //获取一级分类的数据
      $categorys = model('Category')->getNormalCategoryByParentId();
      $this->assign('categorys',$categorys);
      // var_dump($categorys);

      return $this->fetch();
    }




    public function add(){
       //1 如果不是post 
       if (!request()->isPost()) {
          $this->error('请求错误');
       }

       //2.开始验证
       $data=input("post.");
       $validate=validate('Bis');
       if (!$validate->scene('add')->check($data)) {
       	   $this->error($validate->getError());
       }
       //print_r($data);



       //获取经纬度
       $lnglat = \Map::getLngLat($data['address']);
       //var_dump($lnglat);
       if (empty($lnglat)||$lnglat['status']!=0||$lnglat['result']['precise']!=1) {
       	  $this->error('无法获取数据，或者匹配地址不精确');
       }

       //判断提交的用户是否存在了
        $accountRes = Model('BisAccount')->get(['username'=>$data['username']]);
        if ($accountRes) {
        	$this -> error("该用户存在,请重新注册");
        }

       //商户基本信息


       //商户基本信息入库
       $bisData = [
          'name' =>$data['name'],
          'city_id' =>$data['city_id'],
          'city_path' =>empty($data['se_city_id'])?$data['city_id']:$data['city_id'].','.$data['se_city_id'],
          'logo' =>$data['logo'],
          'licence_logo' =>$data['licence_logo'],
          'description' =>empty($data['description'])?'':trim($data['description']),
          'bank_info' =>$data['bank_info'],
          'bank_user' =>$data['bank_user'],
          'bank_name' =>$data['bank_name'],
          'faren' =>$data['faren'],
          'faren_tel' =>$data['faren_tel'],
          'email' =>$data['email'],

       ]; 
   
         $bisId= model('Bis')->add($bisData);
         //var_dump($bisres);

       //总店的信息验证

       //入库  
         $data['cat']='';
         if (!empty($data['se_category_id'])) {
         	//$data['category_id']:$data['category_id']
         	$data['cat']=implode("|",$data['se_category_id']);
         }
        $locationData = [
          'bis_id'    =>  $bisId,
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
          'is_main'   =>  1,  //表示总店信息
          'xpoint'    => empty($lnglat['result']['location']['lng'])?'': $lnglat['result']['location']['lng'],
          'ypoint'    => empty($lnglat['result']['location']['lat'])?'': $lnglat['result']['location']['lat'],
       ]; 
       $locationId= model('BisLocation')->add($locationData);

       //var_dump($locationId);
       // exit();

       //自动生成密码 后缀 字符串
       $data['code']=mt_rand(100,10000);

       //账户相关验证
        $accountData = [
          'bis_id'    => $bisId,
          'username'  => $data['username'],
          'code'      => $data['code'],
          'password'  => md5($data['password'].$data['code']),
          'is_main'   => 1,  //代表总店管理员
       ]; 
       $accountId= model('BisAccount')->add($accountData);
       var_dump($accountId);

       if (!$accountId) {
       	 $this->error('申请失败');
       }

       //发送邮件给客户    让客户激活账号
       $url    = request()->domain().url('bis/register/waiting',['id' =>$bisId]);
       $to     = $data['email'];
       $title  = "o2o入住申请通知";
       $content= "您提交的入驻申请需等待平台审核，您可以通过点击链接<a href='".$url."' target='_blank'>查看链接</a>查看审核状态";

       \phpmailer\Email::send($to,$title,$content);
       
       $this->success('申请成功',url('register/waiting',['id' =>$bisId]));

    }

    public function waiting($id){
          
        if (empty($id)) {
        	$this ->error('error');
        }

        $detail = model('Bis')->get($id);
        $this->assign("detail",$detail);
        return $this->fetch();
    	//var_dump(request());
    	




    }

}