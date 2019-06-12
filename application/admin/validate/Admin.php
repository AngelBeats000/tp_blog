<?php
namespace app\admin\validate;
use think\Validate;
class Admin extends Validate
{
     protected $rule = [
        'username'  =>  'require|max:30|unique:admin',
        'password' =>  'require',
    ];
     protected $message  =   [
        'username.require' => '名称必须',
        'username.max'     => '名称最多不能超过30个字符',
        'username.unique'   => '名称已存在',
        'password.require' => '密码为必填项',
    ];
    protected $scene = [
        'add'  =>  ['username','password'],
        'edit'=>['username'],
    ];
}
