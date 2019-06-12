<?php
namespace app\admin\validate;
use think\Validate;
class Links extends Validate
{
     protected $rule = [
        'title'  =>  'require|max:30',
        'url' =>  'require',
        'desc' =>  'max:255',
    ];
     protected $message  =   [
        'title.require' => '链接名称必须',
        'title.max'     => '链接名称最多不能超过30个字符',
        'url.require' => '链接地址必须存在',
        'desc.max' => '链接描述最多255个字符',
    ];
    protected $scene = [
        'add'  =>  ['title','url','desc'],
        'edit'=>['title','url','desc'],
    ];
}
