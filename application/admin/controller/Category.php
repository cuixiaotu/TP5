<?php
namespace app\admin\controller;
use think\Controller;


class Category extends Controller
{

   private $obj;
   public function _initialize(){
    $this->obj=model('Category');
   }


    public function index()
    {

      $parentId= input('get.parent_id',0,'intval');
     
      $categorys = $this->obj->getFirstCategory($parentId);
      $this->assign('categorys',$categorys);
      return $this->fetch();
    }


    public function add()
    {
     $categorys = $this->obj->getNormalFirstCategory();
     $this->assign('categorys',$categorys);
     return $this->fetch();
    }

   public function save()
   {
    // print_r($_POST);  
    // print_r(input('post.'));  
    // print_r(request()->post());  
    /*判断*/
    if(!request()->isPost()){
      $this->error("请求失败");
    }

    $data = input('post.');
    $validate = validate('Category');
	
    /*场景设置*/

	  if (!$validate->scene('add')->check($data)) {
	    $this->error($validate->getError());
	  }

     
    if (!empty($data['id'])) {
       return $this->update($data);
     }
    //把data数据放入model层
    $res=$this->obj->add($data);
    if ($res) {
      $this->success('新增成功');
    }else{
      $this->success('新增失败'); 
    }

   }

   //编辑页面
   public function edit($id=0){
   if (intval($id)<1) {
     $this->error('参数不合法');
   }
     

     $category = $this->obj->get($id);

     $categorys = $this->obj->getNormalFirstCategory();

     $this->assign('category',$category);
     $this->assign('categorys',$categorys);
     return $this->fetch();
  
   }

   //更新操作
   public function update($data){

   $res = $this->obj->save($data,['id'=>intval($data['id'])]);
   if ($res) {
     $this ->success('更新成功');
   }else{
     $this->error('更新失败');
   }
   }


   //排序
   public function listorder($id,$listorder){
   //echo $id."<br/>".$listorder;

   $res = $this->obj->save(['listorder'=>$listorder],['id'=>intval($id)]);
   if ($res) {
     $this ->result($_SERVER['HTTP_REFERER'],1,'更新成功');
   }else{
     $this->result($_SERVER['HTTP_REFERER'],0,'更新失败');
   }
   } 


   //更改状态
   public function status(){

   //var_dump(input("get."));

   $data = input('get.');
   $validate = validate('Category');
  
    /*场景设置*/

    if (!$validate->scene('status')->check($data)) {
      $this->error($validate->getError());
    }
   
    $res=$this->obj->save(['status'=>$data['status']],['id'=>intval($data['id'])]);

   if ($res) {
     $this ->success('状态更新成功');
   }else{
     $this->error('状态更新失败');
   }


   }   

    

}
