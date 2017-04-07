<?php
namespace app\admin\validate;
use think\Validate;
class Category extends Validate{
	protected $rule =[
    ['name','require|max:10','分类名必须传递|分类名长度不能超过10'],
    ['parent_id','number'],
    ['id','number'],
    ['status','number|in:0,1,-1','状态必须是数字|状态范围不合法'],
    ['listorder','number'],
	];
   
   /*场景设置 */
    protected $scene=[
    'add'  => ['name','parent_id','id'],  //添加    
    'listorder' =>['listorder','id'],    //排序
    'status'=>['status','id'], 
    ];

}


