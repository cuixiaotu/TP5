<?php
namespace app\bis\controller;
use think\Controller;

class Login extends controller
{

   public function index(){
   	if (request()->isPost()) {
   		//登录相关逻辑
         $data=input("post.");
         //通过用户名 获取用户信息
         $ret=model("BisAccount")->get(['username'=>$data['username']]);
         if (!$ret||$ret->status !=1) {
          	$this->error('该用户不存在，或者用户未被审核通过');
          } 
         
         if ($ret->password != md5($data['password'].$ret->code)) {
            $this->error('密码不正确');
          } 

          model("BisAccount")->updateById(["last_login_time"=>time()],$ret->id);
         //保存用户信息     bis为作用域
          session('bisAccount',$ret,'bis');
          return $this->error('登录成功',url("index/index"));

   	}else{
   		//获取session
        $account =session('bisAccount','','bis');  
        if ($account&&$account->id) {
        	return $this->redirect(url('index/index'));
        }
   	    return $this->fetch();
   	}    
   }


    public function logout(){
     //清楚session
    session(null,'bis');
    $this->redirect(url('bis/login/index'));

    }





}