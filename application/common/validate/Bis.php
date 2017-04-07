<?php
namespace app\common\validate;
use think\Validate;
class Bis extends Validate{
	protected $rule =[
    ['name','require|max:25','商户名必须传递|商户名长度不能超过25'],
    ['city_id','require','城市必须选择'],
    ['logo','require','logo必须上传'],
    ['licence_logo','require','营业执照必须上传'],
    ['description','require','城市必须填写'],

    
    ['bank_info','require','银行账号必须填写'],
    ['bank_name','require','开户行名称必须填写'],
    ['bank_user','require','开户名必须填写'],
    ['faren','require','法人必须填写'],
    ['faren_tel','require','法人电话必须填写'],
    ['email','email','请输入合法邮箱'],
    //总店信息
    ['tel','require','门店电话必须填写'],    
    ['contact','require','联系人必须填写'],    
    ['category_id','require','分类必须填写'],  
    ['address','require','地址必须填写'],  
    ['open_time','require','营业时间必须填写'],  
    ['content','require','门店介绍必须填写'],  
    
    //账号密码 
    ['username','require','登录名必须填写'],   
    ['password','require','登录密码必须填写'],    

	];
   
   /*场景设置 */
    protected $scene=[
    'add'  => ['name','city_id','email','logo','licence_logo','description','bank_info','bank_name','bank_user','faren','faren_tel','tel','contact','category_id','address','open_time','content','username','password'],  //添加    

    ];

}


