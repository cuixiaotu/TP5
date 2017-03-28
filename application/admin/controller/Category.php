<?php
namespace app\admin\controller;
use think\Controller;


class Category extends Controller
{
    public function index()
    {
      return $this->fetch();
    }


    public function add()
    {
     return $this->fetch();
    }

   public function save()
   {
    // print_r($_POST);  
    // print_r(input('post.'));  
    // print_r(request()->post());  

    //加载外面的类失败 直接实例化该类  独立验证
 //    $validate = new Validate([
 //    [ 'name' ,'require|max:10','字段不能为空|分类名不能超过10个字符'],
 //    [ 'parent_id' ,'number'],
 //    [ 'id' ,'number'],
 //    [ 'status' ,'number|in:-1,0,1','状态必须为数字|状态范围不合法'],    
 //    [ 'listorder' ,'number'],         

	// ]);


    $data = input('post.');
    
    $validate = validate('Category');
	/*场景设置*/
    
    $sence="";

	if (!$validate->check($data)) {
	    $this->error($validate->getError());
	}




  


   }

    

}
