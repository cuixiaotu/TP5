<?php
namespace app\admin\validate;
use think\Validate;


class Categoty extends Validate
{

     protected $rule = [
    
	   [ 'name' ,'require|max:10','字段不能为空|分类名不能超过10个字符'],
	   [ 'parent_id' ,'number'],
  
        ];




}