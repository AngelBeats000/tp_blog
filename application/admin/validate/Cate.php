<?php
namespace app\admin\validate;
use think\Validate;
class Cate extends Validate
{
     protected $rule = [
        'catename'  =>  'require|max:30|unique:cate',
    ];
     protected $message  =   [
        'catename.require' => '栏目名称必须',
        'catename.max'     => '栏目名称最多不能超过30个字符',
        'catename.unique'  => '栏目名称不能重复',
    ];
    protected $scene = [
        'add'  =>  ['catename'],
        'edit'=>['catename'],
    ];
}
